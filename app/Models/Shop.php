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
        'phone', 'whatsapp_phone', 'email', 'is_branch', 'parent_slug',
        'manager_id', 'fb_link', 'ins_link', 'address'
    ];

    public function user(){
        
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function parent(){
        return $this->belongsTo(Shop::class, 'parent_slug', 'slug');
    }

    public function branches(){
        return $this->hasMany(Shop::class, 'parent_slug', 'slug');
    }

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function town(){
        return $this->belongsTo(Town::class, 'town_id');
    }

    public function street(){
        return $this->belongsTo(Street::class, 'street_id');
    }

    public function location(){
        return ($this->street->name??null).', '.($this->town->name??null).', '.($this->region->name??null);
    }

    public function products(){
        return $this->hasMany(Product::class, 'shop_id');
    }

    public function manager(){
        return $this->hasOne(Manager::class, 'business_id');
    }
}
