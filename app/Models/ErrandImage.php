<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrandImage extends Model
{
    use HasFactory;
    
    protected $table = 'item_quote_images';

    protected $fillable = [
        'item_quote_id',
        'image'
    ];

    public function errand()
    {
        # code...
        return $this->belongsTo(Errand::class, 'item_quote_id');
    }
}
