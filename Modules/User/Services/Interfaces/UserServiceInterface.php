<?php
/**
 * Author: Dieudonne Takougang
 * Date: 11/10/2020
 * @Description: Handle all user business logic exposed as an interface
 */

namespace Modules\User\Services\Interfaces;


interface UserServiceInterface
{
    public function saveUserAccount(array $user);

    public function findUserByID($user_id);

    public function findUserByEmail($email);

    public function emailExist($email);

    public function getUserProducts($user_id);

    public function isValidUsernamePassword($username, $password);

    public function updateUserAccount(array $user, $user_id);

    public function deleteUserAccount($user_id);

    public function saveUserPasswordReset(array $passwordReset);

    public function getPasswordResetDetailsBySlug($slug);

    public function deletePasswordReset($resetId);

    public function getUserProfileInfo($userId);

    public function saveUserProfileInfo($userId,$data);

}
