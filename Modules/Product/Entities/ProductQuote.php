<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductCategory\Entities\SubCategory;
use Modules\User\Entities\User;

class ProductQuote extends Model
{
    use SoftDeletes;

    protected $table = "product_quote";
    protected $fillable = ['title', 'description', 'phone_number', 'UserID', 'categories','slug'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(ProductQuoteImage::class, 'quote_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
