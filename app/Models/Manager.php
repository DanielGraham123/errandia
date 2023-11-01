<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Manager extends User
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'business_id', 'user_id', 'slug'];

    public function manager_to(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shops(){
        return $this->belongsTo(Shop::class, 'business_id');
    }
}
