<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopManager extends Model
{
    use HasFactory;

    protected $table = "shop_managers";

    protected $fillable = ['shop_id', 'user_id', 'is_owner', 'status'];

    public function shop()
    {
        # code...
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        # code...
        return $this->belongsTo(User::class);
    }
}
