<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;
use App\Models\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
        'password',
        'active',
    ];
    protected $connection = 'mysql';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roleR()
    {
        return $this->hasMany(UserRole::class);
    }

    public function shops(){
        return $this->hasMany(Shop::class, 'user_id');
    }

    public function managers(){
        return $this->hasMany(Manager::class, 'user_id');
    }

}
