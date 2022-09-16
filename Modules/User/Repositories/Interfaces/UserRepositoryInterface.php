<?php
/**
 * User: Dieudonne Takougang
 * Date: 11/10/2020
 * @Description: Handle all user related communicated with database
 */

namespace Modules\User\Repositories\Interfaces;


interface UserRepositoryInterface
{
    public function create(array $user);

    public function findUserById($user_id);

    public function findUserByEmail($email);

    public function update(array $user, $user_id);

    public function getUserProducts($user_id);

    public function delete($user_id);

    public function saveUserPasswordReset(array $password);

    public function findPasswordResetBySlug($slug);

    public function findUserProfileByUserId($userId);

    public function saveUserProfileInfo($userId, $data);
}
