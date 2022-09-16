<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class ProductEnquiry extends Model
{

    protected $table = "product_enquiry";
    protected $fillable = ['title', 'description', 'product_id', 'buyer_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
	
	public function images()
    {
        return $this->hasMany(ProductEnquiryImage::class, 'enquiry_id');
    }
	
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
