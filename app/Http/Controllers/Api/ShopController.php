<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\Shop;
use App\Models\SubCategory;
use App\Services\ShopService;
use Illuminate\Http\Request;
use PHPUnit\Exception;

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
            response(),
            'shops loaded',
            self::convert_paginated_result(
                $shops_page,
                ShopResource::collection($shops_page)
            )
        );
    }

    public function featured_shops(Request $request)
    {
        $shops = $this->shopService->load_featured_businesses();
        return $this->build_success_response(
            response(),
            'shops loaded',
            [
                'items' => ShopResource::collection($shops)
            ]
        );
    }

    public function getCategories()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return response()->json(['data' => CategoryResource::collection($categories)]);
    }

    public function getSubCategories(Request $request)
    {
        $categories = SubCategory::query();
        $categories = $categories->when($request->name, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%')
                ->orWhere('description', 'like', '%' . $name . '%');
        });
        $categories = $categories->orderBy('name', 'asc')->get();
        if (empty($categories)) $categories = SubCategory::orderBy('name', 'asc')->get();

        return response()->json(['data' => SubCategoryResource::collection($categories)]);
    }

    public function store(Request $request) {
        try {
            // validate inputs
            $rules = [
                'name' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'phone' => 'required',
                'email' => 'email',
                'region_id' => 'required',
//                'town_id' => 'required',
            ];

            $data = $request->all();
            $this->validate($data, $rules);
            if(!empty($this->validations_errors)) {
                return $this->build_response(response(), 'failed to create business', 400);
            }

            $user = auth('api')->user();
            $data['user'] = $user;
            $created = $this->shopService->save($data);
            return $this->build_success_response(
                response(),
                'Shop created successfully',
                [
                    'item' => new ShopResource($created)
                ]
            );
        } catch (\Exception $e) {
            logger()->error('Error creating shop: ' . $e->getMessage());
            return $this->build_error_response($e->getMessage(), 'failed to create business', 400);
        }
    }

    // get a shop by id
    public function show($slug) {
        try {
            $shop = $this->shopService->getBySlug($slug);
            return $this->build_success_response(
                response(),
                'Shop loaded',
                [
                    'item' => new ShopResource($shop)
                ]
            );
        } catch (\Exception $e) {
            logger()->error('Error loading business: ' . $e->getMessage());
            return $this->build_response(response(), 'failed to load business', 400);
        }
    }

    // get user shops
    public function getUserShops(Request $request) {
        try {
            $user = auth('api')->user();
            $shops = $this->shopService->getUserShops($user);
            return $this->build_success_response(
                response(),
                'Shops loaded',
               self::convert_paginated_result(
                    $shops,
                    ShopResource::collection($shops)
                )
            );
        } catch (\Exception $e) {
            logger()->error('Error loading user shops: ' . $e->getMessage());
            return $this->build_response(response(), 'failed to load businesses', 400);
        }
    }

    public function update(Request $request, $slug) {
        try {
            $shop = $this->shopService->getBySlug($slug);
            $authenticatedUser = auth('api')->user();
            $this->checkOwner($shop,  $authenticatedUser);
            $shop = $this->shopService->update_shop($request, $shop);
            return $this->build_success_response(
                response(),
                'Shop updated successfully',
                ['item' => new ShopResource($shop)]
            );
        } catch (\Exception $e) {
            logger()->error('Error updating shop: ' . $e->getMessage());
            return $this->build_error_response($e->getMessage(), 'failed to update business details', 400);
        }
    }

    public function delete(Request $request, $slug)
    {
        try {
            $shop = $this->shopService->getBySlug($slug);
            $authenticatedUser = auth('api')->user();
            $this->checkOwner($shop,  $authenticatedUser);
            $this->shopService->delete($slug);
            return $this->build_success_response(
                response(),
                'Shop deleted successfully',
            );
        } catch (\Exception $e) {
            logger()->error('Error updating shop: ' . $e->getMessage());
            return $this->build_error_response($e->getMessage(), 'failed to delete shop', 400);
        }
    }

    public function deleteFeaturedImage(Request $request, $slug) {
        try {
            $shop = $this->shopService->getBySlug($slug);
            $authenticatedUser = auth('api')->user();

            if ($this->is_owner($shop, $authenticatedUser) === false) {
                return $this->build_response(
                    response(),
                    'You are not authorized to update this shop.',
                    403
                );
            }

            $shop = $this->shopService->deleteFeaturedImage($shop);
            return $this->build_success_response(
                response(),
                'Featured image deleted successfully',
                ['item' => new ShopResource($shop)]
            );
        } catch (\Exception $e) {
            logger()->error('Error deleting featured image: ' . $e->getMessage());
            return $this->build_error_response($e->getMessage(), 'failed to delete featured image', 400);
        }
    }

    public function otherShops(Request $request, $slug) {
        try {
            $shop = $this->shopService->getBySlug($slug);
            $otherShops = $shop->otherShops();
            return $this->build_success_response(
                response(),
                'Other shops loaded',
               self::convert_paginated_result(
                    $otherShops,
                    ShopResource::collection($otherShops)
                )
            );
        } catch (\Exception $e) {
            logger()->error('Error loading other shops: ' . $e->getMessage());
            return $this->build_response(response(), 'failed to load other shops', 400);
        }
    }

    public function getItemsByShop(Request $request, $slug) {
        try {
            $isService = $request->query('service');
            $shop = $this->shopService->getBySlug($slug);

            if ($shop == null) {
                throw new \Exception('Shop not found');
            }

            $items = $this->shopService->getItemsByShop($slug, $isService);

            return $this->build_success_response(
                response(),
                'Items loaded',
               self::convert_paginated_result(
                    $items,
                    ProductResource::collection($items)
                )
            );
        } catch (\Exception $e) {
            logger()->error('Error loading items: ' . $e->getMessage());
            return $this->build_error_response($e->getMessage(), 'failed to load items', 400);
        } catch (\Throwable $th) {
            logger()->error('Error loading items: ' . $th->getMessage());
            return $this->build_error_response($th->getMessage(), 'failed to load items', 400);
        }
    }

    private function checkOwner($shop, $authenticatedUser)
    {
        if ($shop->user_id !== $authenticatedUser->id) {
            return $this->build_response(
                response(),
                'You are not authorized to update this shop.',
                403
            );
        }
    }
}
