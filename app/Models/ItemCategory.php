<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;
     protected $fillable = ['item_id', 'category_id'];
     protected $table = 'item_categories';

     public function categoty()
     {
        # code...
        return $this->belongsTo(Category::class, 'category_id');
     }

     public function item()
     {
        # code...
        return $this->belongsTo(Product::class, 'item_id');
     }
}
