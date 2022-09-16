<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductEnquiryImage extends Model
{
    protected $table = "product_enquiry_images";

    protected $fillable = ['enquiry_id', 'image_path'];

    public function enquiry()
    {
        $this->belongsTo(Enquiry::class);
    }
}
