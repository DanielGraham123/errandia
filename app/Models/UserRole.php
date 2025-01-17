<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permissions\HasPermissionsTrait;

class UserRole extends Authenticatable
{
    public $table = "users_roles";
    protected $connection = 'mysql';

    public function role()
    {
        # code...
        return $this->belongsTo(Role::class, 'role_id');
    }
}
