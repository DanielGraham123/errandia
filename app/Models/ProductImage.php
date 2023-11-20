<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'item_images';

    public function getImage()
    {
        return $this->image ? asset('storage/'. $this->image) : '';
    }
}
