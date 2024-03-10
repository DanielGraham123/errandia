<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = ['plan_id', 'user_id', 'amount', 'status', 'expired_at'] ;

    public function plan(){
        return $this->belongsTo(Plan::class, 'plans');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users');
    }
}
