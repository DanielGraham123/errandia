<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getCategories(Request $request) 
    {
        $categories = SubCategory::query();
        $categories = $categories->when($request->name, function ($query, $name) {
            $query->where('description', 'like', '%'.$name.'%');
        });
        $categories = $categories->orderBy('name', 'asc')->get();
        if(empty($categories))$categories = SubCategory::orderBy('name', 'asc')->get();

        return response()->json(['data' => SubCategoryResource::collection($categories)]);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        
    }
}
