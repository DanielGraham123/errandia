<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'password', 'active'];

    public function roles(){
        return $this->belongsToMany(Role::class, UserRole::class, 'role_id','user_id')->where('user_type', 'admin');
    }

    public function permissions(){
        return $this->belongsToMany(Role::class, UserRole::class, 'permission_id','user_id')->where('user_type', 'admin');
    }
}
