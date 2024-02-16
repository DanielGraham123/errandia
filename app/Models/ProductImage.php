<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'item_images';

    protected $fillable = [
        'item_id',
        'image',
        'created_at',
        'updated_at'
    ];

    public function getImage()
    {
        return $this->image ? $this->image : '';
    }

    public function item()
    {
        # code...
        return $this->belongsTo(Product::class, 'item_id');
    }
}
