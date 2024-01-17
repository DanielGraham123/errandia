<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categories';

    public function sub_categories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function getIcon()
    {
        return $this->image_path ? asset('assets/admin/icons/'. $this->image_path. '.svg') : '';
    }
}
