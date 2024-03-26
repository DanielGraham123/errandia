<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrandResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Models\Errand;
use App\Models\ErrandImage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Exception;

class ErrandController extends Controller
{
    public function index()
    {
        $errands = Errand::select('item_quotes.*')
            ->leftJoin('users', 'item_quotes.user_id', '=', 'users.id')
            ->where('user_id', '<>', '0')
            ->orderBy('item_quotes.created_at', 'desc')
            ->paginate(10);
        return $this->build_success_response(
            response(),
            'errands loaded',
            self::convert_paginated_result(
                $errands,
                ErrandResource::collection($errands)
            )
        );
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
                $errand->title = $request->get('title');
                $errand->description = $request->get('description');
                $errand->slug = Str::slug($request->get('title')). '-' . time();
                $errand->sub_categories = trim($request->get('categories'));
                $errand->region_id = $request->get('region_id');
                $errand->town_id = $request->get('town_id');
                $errand->street_id = $request->get('street_id');
                $errand->visibility = $request->get('visibility');
                $errand->read_status = false;
                $errand->save();

                if (isset($data['images']) && is_array($data['images'])) {
                    foreach ($data['images'] as $errand_image) {
                        $image = new ErrandImage();
                        $image->item_quote_id = $errand->id;
                        $image->image = $this->uploadImage($errand_image, 'errands');
                        $image->save();
                    }
                }
                return $errand;
            });

            return $this->build_success_response(response(), 'Errand saved');
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed to save errand details.');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::transaction(function() use ($request, $id) {
                $errand = Errand::find($id);
                if (!$errand) {
                    throw new Exception("Errand not found");
                };
                foreach($errand->images as $image) {
                    Storage::delete($image->image);
                    $image->delete();
                }
                $errand->delete();
            });
            return $this->build_success_response(response(), 'Errand deleted successfully');
        } catch(\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed to delete errand');
        }
    }

    private function uploadImage($file, $folder)
    {
        $path = public_path("uploads/$folder/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fName = 'errand_image_' . '_' . time(). '.' . $file->getClientOriginalExtension();
        $file->move($path, $fName);

        return "uploads/$folder/$fName";
    }
}
