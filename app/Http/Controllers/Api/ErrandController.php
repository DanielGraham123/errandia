<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrandResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Models\Errand;
use App\Models\ErrandImage;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ErrandController extends Controller
{
    public function index()
    {
        $errands = Errand::orderBy('created_at', 'desc')->paginate(20);
        return response()->json(['data' => [
            'errands' => ErrandResource::collection($errands)
        ]]);
    }

    public function runErrand(Request $request)
    {
        $products = Product::where('service', false);
        $services = Product::where('service', true);
        $shops = new Shop();

        // filter by search keyword
        if ($request->search) {
            $products = $products->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%')
                    ->orWhere('search_index', 'like', '%'.$request->search.'%');
            });
            $services = $services->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%')
                    ->orWhere('search_index', 'like', '%'.$request->search.'%');
            });
            $shops = $shops->whereHas('products', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        // filter by category
        if ($request->category_id) {
            $products = $products->whereHas('subCategories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
            $services = $services->whereHas('subCategories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
            $shops = $shops->whereHas('subCategories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        }

        // filter by categories
        if ($request->categories) {
            $categories = explode(",", trim($request->categories));
            $categories = array_map('intval', $categories);
            $products = $products->whereHas('subCategories', function ($query) use ($categories) {
                $query->whereIn('category_id', $categories);
            });
            $services = $services->whereHas('subCategories', function ($query) use ($categories) {
                $query->whereIn('category_id', $categories);
            });
            $shops = $shops->whereHas('subCategories', function ($query) use ($categories) {
                $query->where('category_id', $categories);
            });
        }

        // filter by region
        if ($request->region_id) {
            $products = $products->whereHas('shop.info.street.town.region', function ($query) use ($request) {
                $query->where('id', $request->region_id);
            });
            $services = $services->whereHas('shop.info.street.town.region', function ($query) use ($request) {
                $query->where('id', $request->region_id);
            });
            $shops = $shops->whereHas('info.street.town.region', function ($query) use ($request) {
                $query->where('id', $request->region_id);
            });
        }

        // filter by town
        if ($request->town_id) {
            $products = $products->whereHas('shop.info.street.town', function ($query) use ($request) {
                $query->where('id', $request->town_id);
            });
            $services = $services->whereHas('shop.info.street.town', function ($query) use ($request) {
                $query->where('id', $request->town_id);
            });
            $shops = $shops->whereHas('info.street.town', function ($query) use ($request) {
                $query->where('id', $request->town_id);
            });
        }

        //  filter by ratings
        if ($request->rating) {
            $products = $products->whereHas('reviews', function ($query) use ($request) {
                $query->where('rating', '>=', intval($request->rating));
            });
            $services = $services->whereHas('reviews', function ($query) use ($request) {
                $query->where('rating', '>=', intval($request->rating));
            });
            $shops = $shops->whereHas('products.reviews', function ($query) use ($request) {
                $query->where('rating', '>=', intval($request->rating));
            });
        }

        // filter by price
        if ($request->start_price && $request->end_price) {
            $products = $products->whereBetween('unit_price', [intval($request->start_price), intval($request->end_price)]);
            $services = $services->whereBetween('unit_price', [intval($request->start_price), intval($request->end_price)]);
        } else if ($request->start_price) {
            $products = $products->where('unit_price', '>=', $request->start_price);
            $services = $services->where('unit_price', '>=', $request->start_price);
        } else if ($request->end_price) {
            $products = $products->where('unit_price', '<=', $request->end_price);
            $services = $services->where('unit_price', '<=', $request->end_price);
        }

        // sort         
        if ($request->sort) {
            $products = $products->orderBy('unit_price', $request->sort == Product::SORT_HIGH_PRICE ? 'desc': 'asc')->get();
            $services = $services->orderBy('unit_price', $request->sort == Product::SORT_HIGH_PRICE ? 'desc': 'asc')->get();
        } else {
            $products = $products->orderBy('created_at', 'desc')->get();
            $services = $services->orderBy('created_at', 'desc')->get();
        }

        $shops = $shops->orderBy('created_at', 'desc')->get();

        return response()->json(['data' => [
            'products' => ProductResource::collection($products),
            'services' => ProductResource::collection($services),
            'shops' => ShopResource::collection($shops)
        ]]);
    }
    
    public function store(Request $request)
    {
        try {
            $created = DB::transaction(function () use ($request) {
                $errand = new Errand();
                $errand->user_id = auth('api')->user()->id;
                $errand->title = $request->title;
                $errand->description = $request->description;
                $errand->slug = Str::slug($request->title). '-' . time();
                $errand->sub_categories = trim($request->categories);
                $errand->read_status = false;
                $errand->save();

                $count = intval($request->image_count);
                for($i = 1; $i <= $count; $i++) {
                    $image_name = 'image_'. $i;
                    if ($request->file($image_name)) {
                        $image = new ErrandImage();
                        $image->item_quote_id = $errand->id;
                        $image->image = $request->file($image_name)->store('errands');
                        $image->save();
                    }
                }
                return $errand;
            });

            return response()->json(['data' => [
                'errand' => new ErrandResource($created)
            ]]);
        } catch (\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
        }
    }

    public function deleteErrand(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $errand = Errand::find($request->errand_id);
                if (!$errand) throw new Exception("Errand not found");
                foreach($errand->images as $image) {
                    Storage::delete($image->image);
                    $image->delete();
                }
                $errand->delete();
            });
            return response()->json(['data' => [
                'message' => 'Errand deleted successfully'
            ]]);
        } catch(\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
        }
    }
}
