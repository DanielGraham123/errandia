<?php

namespace App\Services;

use App\Jobs\ErrandJob;
use App\Models\Errand;
use App\Models\ErrandImage;
use App\Models\ErrandItem;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\ErrandRepository;
use Google\Auth\Cache\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Exception;

class ErrandService{

    private $errandRepository, $categoryRepository;
    private $validationService;
    private ElasticSearchProductService $searchProductService;
    public function __construct(ErrandRepository $errandRepository,
                                ValidationService $validationService,
                                CategoryRepository $categoryRepository,
                                ElasticSearchProductService $searchProductService
    ){
        $this->errandRepository = $errandRepository;
        $this->validationService = $validationService;
        $this->categoryRepository = $categoryRepository;
        $this->searchProductService = $searchProductService;
    }

    public function get($size=null, $filter=null)
    {
        # code...
        return $this->errandRepository->get($size, $filter);
    }

    public function getRecieved($size, $user_id)
    {
        # code...
        return $this->errandRepository->recievedErrands($size, $user_id);
    }


    public function load_errands($user_id = null)
    {
        $query =  Errand::select('item_quotes.*')
            ->leftJoin('users', 'item_quotes.user_id', '=', 'users.id');
            if ($user_id) {
                $query->where('user_id', $user_id);
            } else {
                $query->where('user_id', '<>', '0');
            }
            return $query
            ->orderBy('item_quotes.created_at', 'desc')
            ->paginate(10);
    }

    public function load_errand($id, $user_id = null)
    {
        $errand = Errand::find($id);

        if($errand == null) {
            throw new \Exception("errand is no longer available");
        }

        if($user_id != null &&  $errand->user_id != $user_id) {
            throw new \Exception("Not Authorized to access to this resource");
        }

        return $errand;
    }

    public function run_errand($id, $user_id, $page = 1)
    {
        $errand = $this->load_errand($id, $user_id);

        if(!$errand) {
            return [];
        }

        // build filter
        $filters = [];
        if($errand->region_id) {
            $filters['region'] = $errand->region_id;
        }

        if($errand->town_id) {
            $filters['town'] = $errand->town_id;
        }

        if($errand->sub_categories) {
            $sub_category_ids = explode(',', $errand->sub_categories);
            $filters['category_ids'] = $sub_category_ids;
        }


        $full_result  = $this->searchProductService->search($errand->title, $filters, null);
        if($full_result['hits']['total']['value'] > 0) {
            ErrandJob::dispatch($full_result['hits']['hits'], $errand)
                ->delay(Carbon::now()->addSeconds(5));
        }

        return $this->searchProductService->search($errand->title, $filters, $page);
    }

    public function update_errand($id, $user_id, $request)
    {
        $errand  = $this->load_errand($id, $user_id);

        $errand->title = $request->get('title');
        $errand->description = $request->get('description');
        $errand->sub_categories = trim($request->get('categories'));
        $errand->region_id = $request->get('region_id');
        $errand->town_id = $request->get('town_id');
        $errand->street_id = $request->get('street_id');
        $errand->visibility = $request->get('visibility');
        $errand->save();
        logger()->info("errand updated");
        return $errand;
    }

    public function add_image($id, $user_id , $request)
    {
        $errand = $this->load_errand($id, $user_id);
        if (!$request->hasFile('image')) {
            throw new \Exception("Image file is required");
        }
        $data = $request->all();
        $image = $this->add_images($errand, $data['image']);
        return $image;
    }

    public function delete_image($id, $errand_id)
    {
        $errand_image = ErrandImage::find($id);
        if($errand_image == null){
            throw new \Exception("image not found");
        }

        if($errand_image->item_quote_id != $errand_id){
            throw new \Exception("You are not authorized");
        }

        MediaService::delete_media($errand_image->image);
        $errand_image->delete();
        logger()->info('Errand image deleted');
    }

    public function delete_errand($id, $user_id)
    {
        $errand = $this->load_errand($id, $user_id);
        DB::transaction(function() use ($errand) {
            foreach($errand->images as $errand_image) {
                $errand_image->delete();
                MediaService::delete_media($errand_image->image);
            }
            $errand->delete();
        });
    }

    public function getOne($slug)
    {
        # code...
        return $this->errandRepository->getBySlug($slug);
    }

    public function proposeCategories($slug)
    {
        # code...
        $errand = $this->errandRepository->getBySlug($slug);
        $title = $errand->title;
        $tokens = explode(' ', $title);

        $props = [];
        foreach ($tokens as $key => $tok) {
            $props[] = SubCategory::where('name', 'LIKE', '%'.$tok.'%')->orWhere('description', 'LIKE', '%'.$tok.'%')->get()->all();
            $props[] = $this->categoryRepository->searchAll([['name'=>$tok, 'description'=>$tok]]);
        }
        $categs = [];
        foreach ($props as $key => $prop) {
            foreach ($prop as $key => $prp) {
                # code...
                $categs[] = $prp;
            }
        }
        return [];
    }

    public function save($data)
    {
        $validationRules = [
            'title'=>'required',
            'description'=>'nullable|string',
            'user_id'=>'required',
            'slug'=>'required',
            'read_status'=>'nullable',
            'sub_categories'=>'nullable',
            'region_id'=>'nullable|numeric',
            'town_id'=>'nullable|numeric',
            'street_id'=>'nullable|numeric',
            'visibility'=>'nullable',
            'status'=>'nullable'
        ];
        $this->validationService->validate($data, $validationRules);
        return $this->errandRepository->store($data);
    }

    public function save_errand($request, $user_id)
    {
        return DB::transaction(function () use ($request, $user_id) {
            $errand = new Errand();
            $errand->user_id = $user_id;
            $errand->title = $request->get('title');
            $errand->description = $request->get('description');
            $errand->slug = Str::slug($request->get('title')). '-' . time();
            $errand->sub_categories = trim($request->get('categories'));
            $errand->region_id = $request->get('region_id');
            $errand->town_id = $request->get('town_id');
            $errand->street_id = $request->get('street_id');
            $errand->visibility = $request->get('visibility');
            $errand->read_status = false;
            $errand->save();

            $data = $request->all();
            if($request->has('images')) {
                logger()->info(gettype($data['images']) . " errand images added");
                $images = $data['images'];
                if (isset($images)) {
                    if (is_array($images)) {
                        $i = 1; // image count
                        foreach ($images as $errand_image) {
                            $this->add_images($errand, $errand_image, $i);
                            $i++;
                        }
                    } else {
                        $this->add_images($errand, $images);
                    }
                }
            }
            return $errand;
        });
    }

    private function add_images($errand, $errand_image, $i = 1): ErrandImage
    {
        $image = new ErrandImage();
        $image->item_quote_id = $errand->id;
        $image->image = $this->uploadImage($errand_image, 'errands', $i);
        $image->save();
        logger()->info('New errand image saved');
        return $image;
    }

    private function uploadImage($file, $folder, $i = 1): string
    {
        $path = public_path("uploads/$folder/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fName = 'errand_image_' . $i . '_' . time(). '.' . $file->getClientOriginalExtension();
        $file->move($path, $fName);

        return "uploads/$folder/$fName";
    }

    public function update($slug, $data)
    {
        $validationRules = ['title'=>'required'];
        $this->validationService->validate($data, $validationRules);
        if(empty($data))
            throw new \Exception('No data provided for update');
        return $this->errandRepository->update($slug, $data);
    }

    /**
     * delete an errand record from database
     * @param int $user_id; the current authenticated user id;
     */
    public function delete($slug, $user_id)
    {
        # code...
        // can only be deleted by the creator
        $errand  = $this->errandRepository->getBySlug($slug);
        if($user_id != $errand->user_id)
            throw new \Exception("An errand can only be deleted by the ceator");
        return $this->errandRepository->delete($slug);
    }

    public function load_errand_results($id, $user_id)
    {
        $errand = $this->load_errand($id, $user_id);

        return $errand->items_found()->select('items.*')->paginate(10);
    }

    public function delete_images($id, $user_id = null): void
    {
        $errand = $this->load_errand($id, $user_id);
        if(!empty($errand->images)){
            foreach ($errand->images as $image){
                $image->delete();
            }
            logger()->info("errand images deleted");
        }
    }

    public function load_errands_received($user_id)
    {
        return Errand::join("item_quotes_sent", 'item_quotes_sent.item_quote_id', 'item_quotes.id')
            ->join("items", 'items.id', 'item_quotes_sent.item_id')
            ->join("shops", 'shops.id', 'items.shop_id')
            ->where('shops.user_id', $user_id)
            ->where('item_quotes.status', 0)
            ->where('item_quotes_sent.rejected', 0)
            ->select('item_quotes.*', 'item_quotes_sent.id as errand_received_id')
            ->orderBy('item_quotes_sent.created_at', 'desc')
            ->paginate(10);
    }

    public function marked_as_found($id, $user_id): void
    {
        $errand = $this->load_errand($id, $user_id);
        $errand->status = 1;
        $errand->save();
        logger()->info("errand status set to marked as found");
    }

    public function reject_errands_received($id1): void
    {
       $errand_item =  ErrandItem::find($id1);
       if($errand_item) {
           $errand_item->rejected = true;
           $errand_item->save();
           logger()->info('errand received  '. $id1 . '  rejected');
       }
    }

}