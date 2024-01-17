<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'amount', 'duration', 'status'] ;

    public function shops(){
        return $this->belongsToMany(Shop::class, 'shop_subscriptions');
    }
}
