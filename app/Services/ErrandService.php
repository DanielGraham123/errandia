<?php

namespace App\Services;

use App\Repositories\ErrandRepository;
use \Illuminate\Support\Facades\Http;

class ErrandService{

    private $errandRepository;
    private $validationService;
    public function __construct(ErrandRepository $errandRepository, ValidationService $validationService){
        $this->errandRepository = $errandRepository;
        $this->validationService = $validationService;
    }

    public function getAll($size)
    {
        # code...
        return $this->errandRepository->get($size);
    }

    public function getOne($slug)
    {
        # code...
        return $this->errandRepository->getBySlug($slug);
    }

    public function save($data)
    {
        # code...
        $validationRules = ['title'=>'required|string', 'user_id'=>'required'];
        $this->validationService->validate($data, $validationRules);
        return $this->errandRepository->store($data);
    }

    public function update($slug, $data)
    {
        # code...
        $validationRules = ['title'=>'required'];
        $this->validationService->validate($data, $validationRules);
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