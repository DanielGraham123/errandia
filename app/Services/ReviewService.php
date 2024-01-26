<?php

namespace App\Services;

use App\Repositories\ReviewRepository;
use \Illuminate\Support\Facades\Http;

class ReviewService{

    private $reviewRepository;
    private $validationService;

    public function __construct(ReviewRepository $reviewRepository, ValidationService $validationService){
        $this->reviewRepository = $reviewRepository;
        $this->validationService = $validationService;
    }

    public function getAll($size = null, $item_id = null)
    {
        # code...
        return $this->reviewRepository->get($size, $item_id);
    }

    public function getOne($id)
    {
        # code...
        return $this->reviewRepository->getById($id);
    }

    public function save($data)
    {
        # code...
        $validationRules = [
            'buyer_id'=>'required|numeric', 'item_id'=>'required|numeric', 'rating'=>'required|numeric', 'review'=>'required|string', 'status'=>'nullable'
        ];
        $this->validationService->validate($data, $validationRules);
        return $this->reviewRepository->store($data);
    }


    public function update($id, $data)
    {
        # code...
        // can only be updated by creator or product owner
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        if(empty($data))
            throw new \Exception("Data not provided for update");
        return $this->reviewRepository->update($id, $data);
    }

    public function delete($id, $user_id)
    {
        # code...
        // can only be deleted by the creator
        $review = $this->reviewRepository->getById($id);
        if($id != $review->user_id)
            throw new \Exception("Permission denied. Review can only be deleted by the creator");
        return $this->reviewRepository->delete($id);
    }

}