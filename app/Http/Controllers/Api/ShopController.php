<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\Shop;
use App\Models\ShopContactInfo;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Paginator;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        $shops_page = Shop::orderBy('created_at', 'desc')->paginate(15);
        return $this->build_success_response(
            response() ,
            'shops loaded',
            self::convert_paginated_result(
                $shops_page, ShopResource::collection($shops_page)
            )
        );
    }

    public function featured_shops(Request $request)
    {
        $shops = Shop::orderBy('created_at', 'desc')->take(10)->get();
        return $this->build_success_response(
            response(),
            'shops loaded',
            [
                'items' => ShopResource::collection($shops)
            ]
        );
    }

    public function getCategories() {
        $categories = Category::orderBy('name', 'asc')->get();
        return response()->json(['data' => CategoryResource::collection($categories)]);
    }

    public function getSubCategories(Request $request) 
    {
        $categories = SubCategory::query();
        $categories = $categories->when($request->name, function ($query, $name) {
            $query->where('name', 'like', '%'.$name.'%')
                ->orWhere('description', 'like', '%'.$name.'%');
        });
        $categories = $categories->orderBy('name', 'asc')->get();
        if(empty($categories))$categories = SubCategory::orderBy('name', 'asc')->get();

        return response()->json(['data' => SubCategoryResource::collection($categories)]);
    }

    public function store(Request $request)
    {
        try {
            $created = DB::transaction(function () use ($request) {
                $user = auth('api')->user();
                $shop = new Shop();
                $shop->name = $request->name;
                $shop->description = $request->description;
                $shop->user_id = $user->id;
                $shop->category_id = 0;
                $shop->status = $request->status ?? true;
                $shop->is_branch = $request->is_branch ?? false;
                $shop->parent_slug = $request->parent_slug ?? '';
                $shop->slug = Str::slug($request->name) . '-' . time();
                $shop->slogan = $request->slogan ?? '';

                if($request->file('image')) {
                    $shop->image_path = $request->file('image')->store('shops');
                }
                $shop->save();
                
                $shop_info = ShopContactInfo::firstOrNew([
                    'shop_id' => $shop->id
                ]);
                $shop_info->street_id = $request->street_id;
                $shop_info->phone = $request->phone ?? '';
                $shop_info->whatsapp = $request->whatsapp ?? '';
                $shop_info->address = $request->address ?? '';
                $shop_info->facebook = $request->facebook ?? '';
                $shop_info->instagram = $request->instagram ?? '';
                $shop_info->website = $request->website ?? '';
                $shop_info->email = $request->email ?? '';
                $shop_info->save();

                $categories = explode(",",trim($request->categories));
                if (count($categories) > 0) $shop->subCategories()->sync($categories);
                return $shop;
            });

           return response()->json(['data' => [
                'message' => 'Shop created',
                'shop' => new ShopResource($created)
           ]]);
        } catch(\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, we encountered an error'
            ]], 500);
        }
    }
}
