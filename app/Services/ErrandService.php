<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ErrandRepository;
use \Illuminate\Support\Facades\Http;

class ErrandService{

    private $errandRepository, $categoryRepository;
    private $validationService;
    public function __construct(ErrandRepository $errandRepository,
                                ValidationService $validationService,
                                CategoryRepository $categoryRepository){
        $this->errandRepository = $errandRepository;
        $this->validationService = $validationService;
        $this->categoryRepository = $categoryRepository;
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


    public function searchAll($size, $filter)
    {
        # code...
        return $this->errandRepository->get($size, $filter);
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

    public function saveImages($data, $quote_id)
    {
        # code...
        $quote_images = [];
        $count = 0;
        foreach ($data as $key => $file) {
            # code...
            if ($count >= 3) {break;}
            $path = public_path('uploads/quote_images');
            $fname = 'qim_'.time().'_'.random_int(100000, 999999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $quote_images[] = ['item_quote_id'=>$quote_id, 'image'=>$fname];
            $count++;
        }
        
        $validationRules = ['item_quote_id'=>'required', 'image'=>'required'];
        if(!empty($quote_images)){
            if(is_array($quote_images[1])){
                foreach ($quote_images as $key => $pair) {
                    # code...
                    $this->validationService->validate($pair, $validationRules);
                }
            }
            $this->errandRepository->saveImages($quote_images);
        }
    }

    public function update($slug, $data)
    {
        # code...
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