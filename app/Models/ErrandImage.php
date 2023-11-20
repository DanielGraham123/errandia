<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrandImage extends Model
{
    use HasFactory;
    
    protected $table = 'item_quote_images';

    public function getImage()
    {
        return $this->image ? asset('storage/'. $this->image) : '';
    }
}
