<?php
/**
 * Author:Dieudonne Takougang
 * Date: 11/10/2020
 * Description: User service implementation
 */

namespace Modules\User\Services;

use Illuminate\Support\Facades\Auth;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use Modules\User\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->userRepository = $repository;
    }

    public function saveUserAccount(array $user)
    {
        return $this->userRepository->create($user);
    }

    public function findUserByID($user_id)
    {
        return $this->userRepository->findUserById($user_id);
    }

    public function findUserByEmail($email)
    {
        return $this->userRepository->findUserByEmail($email);
    }

    public function emailExist($email)
    {
        $emailExist = $this->findUserByEmail($email);
        return $emailExist->isEmpty() ? false : true;
    }

    public function getUserProducts($user_id)
    {
        return collect($this->userRepository->getUserProducts($user_id));
    }

    public function isValidUsernamePassword($username, $password)
    {
        $credentials = ["email" => $username, "password" => $password];
        return Auth::attempt($credentials) ? true : false;
    }

    public function updateUserAccount(array $user, $user_id)
    {
        return $this->userRepository->update($user, $user_id);
    }

    public function deleteUserAccount($user_id)
    {
        return $this->userRepository->delete($user_id);
    }

    public function getAllUsers($keyword)
    {
        return $this->userRepository->getAllUsers($keyword);
    }

    public function getAllAdminUsers()
    {
        return $this->userRepository->getAllAdminUsers();
    }

    public function suspendUser($id)
    {
        return $this->userRepository->suspendUser($id);
    }

    public function activeUser($id)
    {
        return $this->userRepository->activeUser($id);
    }

    public function deletePasswordReset($resetId)
    {
        return DB::table("password_resets")->where('id', $resetId)->delete();
    }

    public function saveUserPasswordReset(array $passwordReset)
    {
        return $this->userRepository->saveUserPasswordReset($passwordReset);
    }

    public function getPasswordResetDetailsBySlug($slug)
    {
        return $this->userRepository->findPasswordResetBySlug($slug);
    }

    public function getUserProfileInfo($userId)
    {
        return $this->userRepository->findUserProfileByUserId($userId);
    }

    public function saveUserProfileInfo($userId, $data)
    {
        return $this->userRepository->saveUserProfileInfo($userId, $data);
    }
}
