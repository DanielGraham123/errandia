<?php

namespace App\Services;

use App\Models\Errand;
use App\Models\ErrandImage;
use App\Repositories\CategoryRepository;
use App\Repositories\ErrandRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                $query->where('user_id', '$user_id');
            } else {
                $query->where('user_id', '<>', '0');
            }
            return $query
            ->orderBy('item_quotes.created_at', 'desc')
            ->paginate(10);
    }

    public function load_errand($id, $user_id = null)
    {
        if($user_id == null) {
            $errand = Errand::find($id);
        } else {
            $errand = Errand::where('id' , $id)->where('user_id', $user_id)->first();
        }

        if($user_id &&  $errand->user_id != $user_id) {
            throw new \Exception("Not Authorized to access to this resource");
        }

        return $errand;
    }

    public function run_errand($id, $user_id)
    {
        $errand = $this->load_errand($id, $user_id);

        if(!$errand) {
            return [];
        }

        logger()->info("Run errand with title : ". $errand->id);

        return $this->searchProductService->search($errand->title);

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
            $props[] = \App\Models\SubCategory::where('name', 'LIKE', '%'.$tok.'%')->orWhere('description', 'LIKE', '%'.$tok.'%')->get()->all();
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
        DB::transaction(function () use ($request, $user_id) {
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
                        foreach ($images as $errand_image) {
                            $this->add_images($errand, $errand_image);
                        }
                    } else {
                        $this->add_images($errand, $images);
                    }
                }
            }
            return $errand;
        });
    }


    private function add_images($errand, $errand_image)
    {
        $image = new ErrandImage();
        $image->item_quote_id = $errand->id;
        $image->image = $this->uploadImage($errand_image, 'errands');
        $image->save();
        logger()->info('New errand image saved');
    }


    private function uploadImage($file, $folder)
    {
        $path = public_path("uploads/$folder/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fName = 'errand_image_' . '_' . time(). '.' . $file->getClientOriginalExtension();
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

}