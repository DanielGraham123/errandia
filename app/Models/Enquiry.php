<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $table = 'item_enquiries';
    protected $fillable = ['item_id', 'buyer_id', 'title', 'description'];

    public function images(){
        return $this->hasMany('item_enquiry_images', 'item_enquiry_id');
    }

    public function replies(){
        return $this->hasMany('item_enquiry_replies', 'item_enquiry_id');
    }
}
