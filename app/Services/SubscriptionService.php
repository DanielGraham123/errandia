<?php

namespace App\Services;

use App\Repositories\SubscriptionPlanRepository;
use \Illuminate\Support\Facades\Http;

class SubscriptionService{

    private $subscriptionPlanRepository;
    private $validationService;


    public function __construct(SubscriptionPlanRepository $subscriptionPlanRepository, ValidationService $validationService){
        $this->subscriptionPlanRepository = $subscriptionPlanRepository;
        $this->validationService = $validationService;
    }

    public function getAll()
    {
        # code...
        return $this->subscriptionPlanRepository->get();
    }

    public function getById($id)
    {
        # code...
        return $this->subscriptionPlanRepository->getById($id);
    }

    public function save($data)
    {
        # code...
        $validationRules = [
            'name'=>'required|string', 'description'=>'required|string', 
            'amount'=>'required|numeric', 'duration'=>'required|numeric', 
            'status'=>'required'
        ];
        $this->validationService->validate($data, $validationRules);
        return $this->subscriptionPlanRepository->store($data);
    }

    public function update($id, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        if(empty($data))
        throw new \Exception("No data provided for update");
        return $this->subscriptionPlanRepository->update($id, $data);
    }

    public function delete($id, $user_id)
    {
        # code...
        // Can only be deleted by the super admin
        return $this->subscriptionPlanRepository->delete($id);
    }

}