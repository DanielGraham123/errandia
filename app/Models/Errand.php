<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Errand extends Model
{
    use HasFactory;

    protected $table = 'item_quotes';

    protected $fillable = ['title', 'description', 'user_id', 'slug', 'read_status', 'sub_categories', 'region_id', 'town_id', 'street_id', 'visibility', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location(){
        return $this->region == null ? '' : ($this->region->country->name.', '.$this->region->name.', '.($this->town == null ? '' : ($this->town->name.', '.($this->street == null ? '' : $this->street->name))));
    }

//    public function sub_categories(){
//        $cats = explode(',', $this->sub_categories);
//        return SubCategory::whereIn('id', $cats)->get();
//    }

    public function getSubcategories(){
        $cats = explode('-', $this->sub_categories);
        return SubCategory::whereIn('id', $cats)->get();
    }

    public function subCategories(){
        $cats = explode(',', $this->sub_categories);
        $sub_categories = SubCategory::whereIn('id', $cats)->pluck('name')->all();
        return empty($sub_categories) ? '' : implode(', ', $sub_categories);
    }


    public function images()
    {
        return $this->hasMany(ErrandImage::class, 'item_quote_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function town()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'street_id');
    }

    public function errand_items()
    {
        return $this->hasMany(ErrandItem::class, 'item_quote_id');
    }

    public function items_found(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            ErrandItem::class,
            'item_quote_id',
            'id',
            'id',
            'item_id'
        );
    }
}
