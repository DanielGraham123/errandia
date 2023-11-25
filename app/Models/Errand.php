<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errand extends Model
{
    use HasFactory;

    protected $table = 'item_quotes';
    protected $fillable = ['title', 'description', 'user_id', 'slug', 'read_status', 'categories', 'region_id', 'town_id', 'street_id'];

    public function posted_by()
    {
        # code...
        return $this->belongsTo(User::class, 'user-id');
    }

    public function location(){
        return null;
    }

    public function _categories(){
        $cats = explode($this->categories, ',');
        return SubCategory::whereIn('id', $cats);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(ErrandImage::class, 'item_quote_id');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'street_id');
    }
}
