<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSubCategory;
use App\Models\Shop;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = new Product();
        if ($request->category_id) {
            $products = $products->whereHas('subCategories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        }
        if ($request->search) {
            $products = $products->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%')
                    ->orWhere('search_index', 'like', '%'.$request->search.'%');
            });
        }

        $products = $products->orderBy('created_at', 'desc')->paginate(20);
        return response()->json(['data' => [
            'products' => ProductResource::collection($products)
        ]]);
    }

    public function store(Request $request)
    {
       try {
        $item = DB::transaction(function () use ($request) {
            $product = new Product();
            $product->name = $request->name;
            $product->shop_id = $request->shop_id;
            $product->description = $request->description;
            $product->unit_price = $request->unit_price;
            $product->slug = Str::slug($request->name).'-'. time();
            $product->status = $request->status ?? true;
            $product->quantity = $request->quantity ?? 0;
            $product->service = $request->service;
            $product->search_index = $this->searchIndex($request);
            $product->views = '';

            if ($request->file('featured_image')) {
                $product->featured_image = $request->file('featured_image')->store('products');
            }
            $product->save();

            $categories = explode(",",trim($request->categories));
            if (count($categories) > 0) $product->subCategories()->sync($categories);

            $count = intval($request->image_count ?? 0);
            for($i = 1; $i <= $count; $i++) {
                $image_name = 'image_'. $i;
                if ($request->file($image_name)) {
                    $image = new ProductImage();
                    $image->item_id = $product->id; 
                    $image->image = $request->file($image_name)->store('products');
                    $image->save();
                }
            }
            return $product;
        });

        return response()->json(['data' => [
            'product' => new ProductResource($item)
        ]]);

       } catch(\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
       }
    }

    public function searchIndex($request) {
        $shop = Shop::find($request->shop_id);
        if (!$shop) return $request->name . $request->description;
        $search_index = $request->name . $request->description . $shop->name . $shop->description . $shop->info->street->name . $shop->info->address;
        $categories = explode(",",trim($request->categories));
        foreach($categories as $cat_id) {
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
            $views = explode(",",trim($product->views));
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
            DB::transaction(function() use ($request) {
                $product = Product::find($request->product_id);
                if (!$product) throw new Exception("Product not found");
                if($product->featured_image) Storage::delete($product->featured_image);
                foreach($product->images as $image) {
                    Storage::delete($image->image);
                    $image->delete();
                }
                $product->subCategories()->detach();
                $product->delete();
            });
            return response()->json(['data' => [
                'message' => 'Product deleted successfully'
            ]]);
        } catch(\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
        }
    }
}
