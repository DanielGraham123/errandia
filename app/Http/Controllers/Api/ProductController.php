<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Shop;
use App\Models\SubCategory;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->getAll($request->size, $request->category_id, $request->service);
        return $this->build_success_response(
            response(),
            'items loaded',
            [
                'items' => $products
            ]
        );
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
//            $rules = [
//                'name' => 'required',
//                'shop_id' => 'required',
//                'image' => 'image',
//                'description' => 'required',
//                'service' => 'required',
//            ];

            // Todo rot review the rules later
            $rules = [
                'name'=>'required',
                'shop_id'=>'required',
                'unit_price'=>'nullable|numeric',
                'description'=>'nullable|string',
                'quantity'=>'nullable|numeric',
                'service'=>'boolean|nullable',
                'tags'=>'nullable',
                'category_id'=>'required'
            ];

            $this->validate($data, $rules);
            if(!empty($this->validations_errors)) {
                return $this->build_response(response(), 'check required fields', 400);
            }

            $user = auth('api')->user();
            $data['user'] = $user;
            $item = $this->productService->save($data, $request);
            return $this->build_success_response(
                response(),
                'Product created successfully',
                [
                    'item' => new ProductResource($item)
                ]
            );

        } catch (\Exception $e) {
            logger()->error('Error creating item: ' . $e->getMessage());
            return $this->build_response(response(), 'process failed', 400);
        }
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {

    }

    // get user products
    public function getUserProducts(Request $request)
    {
        try {
            $user = auth('api')->user();
            $products = $this->productService->getUserProducts($user);

            return $this->build_success_response(
                response(),
                'products loaded',
               self::convert_paginated_result(
                    $products,
                    ProductResource::collection($products)
                )
            );
        } catch (\Exception $e) {
            logger()->error('Error loading user products: ' . $e->getMessage());
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
        }
    }

    // get user services
    public function getUserServices(Request $request)
    {
        try {
            $user = auth('api')->user();
            $products = $this->productService->getUserServices($user);

            return $this->build_success_response(
                response(),
                'services loaded',
               self::convert_paginated_result(
                    $products,
                    ProductResource::collection($products)
                )
            );
        } catch (\Exception $e) {
            logger()->error('Error loading user services: ' . $e->getMessage());
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
        }
    }

    public function searchIndex($request)
    {
        $shop = Shop::find($request->shop_id);
        if (!$shop) return $request->name . $request->description;
        $search_index = $request->name . $request->description . $shop->name . $shop->description . $shop->info->street->name . $shop->info->address;
        $categories = explode(",", trim($request->categories));
        foreach ($categories as $cat_id) {
            $sub_category = SubCategory::find($cat_id);
            $search_index = $search_index . $sub_category->name . $sub_category->description;
        }
        return $search_index;
    }

    public function view(Request $request)
    {
        $product = Product::find($request->product_id);
        $user = auth('api')->user();
        if ($product) {
            $views = explode(",", trim($product->views));
            if (!in_array($user->id, $views)) {
                array_push($views, $user->id);
                $product->views = implode(",", $views);
                $product->save();
            }
        }
        return response()->json(['data' => []]);
    }

    public function relatedProducts(Request $request)
    {
        $product = Product::find($request->product_id);
        $related_products = Product::with('subCategories');
        if (!$product) return response()->json(['data' => ['products' => []]]);
        $related_products = $related_products->where('shop_id', $product->shop->id);
        if ($request->category_id) {
            $related_products = $related_products->whereHas('subCategories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        }
        $related_products = $related_products->where('id', '!=', $product->id)
            ->orderBy('created_at', 'desc')
            ->take(10)->get();
        return response()->json(['data' => ['products' => ProductResource::collection($related_products)]]);
    }

    public function deleteProduct(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $product = Product::find($request->product_id);
                if (!$product) throw new Exception("Product not found");
                if ($product->featured_image) Storage::delete($product->featured_image);
                foreach ($product->images as $image) {
                    Storage::delete($image->image);
                    $image->delete();
                }
                $product->subCategories()->detach();
                $product->delete();
            });
            return response()->json(['data' => [
                'message' => 'Product deleted successfully'
            ]]);
        } catch (\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
        }
    }
}
