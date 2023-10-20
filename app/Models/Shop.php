<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'category_id', 'user_id', 'slug', 
        'image_path', 'status', 'name', 'category', 
        'description', 'region_id', 'town_id', 'street_id', 'website', 
        'phone', 'whatsapp_phone', 'email', 'type'
    ];

    public function user(){
        
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
