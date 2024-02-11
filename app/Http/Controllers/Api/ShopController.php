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
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Paginator;

class ShopController extends Controller
{

    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

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
            $shopData = $request->all();
            $created = $this->shopService->save($shopData);

            return $this->build_success_response(
                response(),
                'Shop created successfully',
                [
                    'item' => new ShopResource($created)
                ]
            );
        } catch(\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, we encountered an error'
            ]], 500);
        }
    }
}