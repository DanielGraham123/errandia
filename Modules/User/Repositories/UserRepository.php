<?php
/**
 * User: Dieudonne Takougang
 * Date: 11/10/202
 * Time: Implementation for user repository interface
 */

namespace Modules\User\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\BaseRepository;
use Modules\User\Entities\User;
use Modules\User\Entities\UserProfile;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $userModel;

    public function __construct(User $model)
    {
        $this->userModel = $model;
    }

    public function create(array $user)
    {
        return $this->userModel->create($user);
    }

    public function findUserById($user_id)
    {
        return $this->userModel->find($user_id);
    }

    public function findUserByEmail($email)
    {
        return $this->userModel->where('email', $email)->get();
    }

    public function update(array $user, $user_id)
    {
        return $this->userModel->find($user_id)->update($user);
    }

    public function getUserProducts($user_id)
    {
        return $this->userModel->find($user_id)->products;
    }

    public function delete($user_id)
    {
        return $this->userModel->find($user_id)->delete();
    }

    public function getAllUsers($keyword)
    {
        if ($keyword == '')
            return $this->userModel->where('user_type', '!=', 10)->paginate(30);
        else
            return $this->userModel->where('user_type', '!=', 10)->where('email', $keyword)->paginate(30);
    }

    public function getAllAdminUsers()
    {
        return $this->userModel->where('user_type', '=', 10)->paginate(30);
    }

    public function suspendUser($id)
    {
        $userDatails = ['status' => 0];
        return $this->userModel->where('id', $id)->update($userDatails);
    }

    public function activeUser($id)
    {
        $userDatails = ['status' => 1];
        return $this->userModel->where('id', $id)->update($userDatails);
    }

    public function saveUserPasswordReset(array $password)
    {
        return DB::table("password_resets")->insertGetId($password);
    }

    public function findPasswordResetBySlug($slug)
    {
        return DB::table("password_resets")->where('slug', $slug)->first();
    }

    public function findUserProfileByUserId($userId)
    {
        return UserProfile::where('user_id', $userId)->with('street.town', 'user')->first();
    }

    public function saveUserProfileInfo($userId, $data)
    {
        //check if the user profile was created befor
        if (!empty($this->findUserProfileByUserId($userId))) {
            //update the user profile info
            return UserProfile::where('user_id', $userId)->update($data);
        } else {
            //add a new user profile info
            return UserProfile::create($data);
        }
    }
}
