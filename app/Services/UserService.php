<?php

namespace App\Services;

use App\Repositories\UserRepository;
use \Illuminate\Support\Facades\Http;

class UserService{

    private $userRepository;
    private $validationService;

    public function __construct(UserRepository $userRepository, ValidationService $validationService){
        $this->userRepository = $userRepository;
        $this->validationService = $validationService;
    }

    public function getAll($size = null)
    {
        # code...
        return $this->userRepository->get($size);
    }

    public function getById($id)
    {
        # code...
        return $this->userRepository->getById($id);
    }

    public function save($data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        return $this->userRepository->store($data);
    }

    public function update($id, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $data);
        return $this->userRepository->update($id, $data);
    }

    public function delete($id, $user_id)
    {
        # code...
        // can only be deleted by super admin or account owner
        return $this->userRepository->delete($id);
    }

}