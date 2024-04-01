<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrandItem extends Model
{
    use HasFactory;

    protected $table = 'item_quotes_sent';
    protected $fillable = ['item_quote_id', 'item_id'];

    public function item()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function errand()
    {
        return $this->belongsTo(Errand::class, 'item_quote_id');
    }
}
