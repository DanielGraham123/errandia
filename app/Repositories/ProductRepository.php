<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;

class ProductRepository
{

    /**
     * get all products
     * @param string|null $category_id : nullable, category id to query products per category
     * @param bool|null $service : nullable, if true|1, returns services only. if false|0, returns products only. otherwise return both
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function get(string $category_id = null, bool $service = null): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $query = Product::query();

        // Filter by category if needed
        if ($category_id !== null) {
            $category = Category::find($category_id);
            if (!$category) {
                throw new Exception("Category does not exist");
            }
            $query->whereHas('category', function ($q) use ($category_id) {
                $q->where('id', $category_id);
            });
        }

        // Filter by service if needed
        if ($service !== null) {
            $query->where('service', $service);
        }

        // Eager load related data
        $query->with(['category', 'shop', 'images']);

        $items = $query->orderBy('id', 'DESC')->paginate(15);

        return ProductResource::collection($items);

    }


    /**
     * get a product or service by slug
     * @param string $slug : unique slug of item to read
     * @throws \Throwable
     */
    public function getBySlug($slug): ProductResource
    {
        try {
            # read the record associated to a given slug
            $item = Product::whereSlug($slug)->first();
            if ($item == null) {
                throw new Exception("Item does not exist");
            }
            return new ProductResource($item);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * get user products
     */
    public function getUserProducts($user)
    {
        // return user products with is_services equals zero
        $items = Product::whereUserId($user->id)->whereService(0)->paginate(15);
        return $items;

//       return Product::whereUserId($user->id)->paginate(15);
    }

    /**
     * get user services
     */
    public function getUserServices($user)
    {
        // return user products with is_services equals one
        $items = Product::whereUserId($user->id)->whereService(1)->paginate(15);
        return $items;
    }

    /**
     * save a record to database
     */
    public function store($data)
    {
        // check if product with name exists
        $item = Product::whereName($data['name'])->first();
        if ($item != null) {
            throw new Exception("Product with name already exists");
        }

        // check if shop with id exists
        $shop = Shop::find($data['shop_id']);
        if ($shop == null) {
            throw new Exception("Shop does not exist");
        }

        // check if category with id exists
        $category = Category::find($data['category_id']);
        if ($category == null) {
            throw new Exception("Category does not exist");
        }

        // validate data and save to database
        try {
            $record = DB::transaction(function () use ($data) {
                // Exclude 'images' from the data array used for creating the product
                $productData = Arr::except($data, ['images', 'productImages']);
                $user = $data['user'];
                $item = new Product($productData);
                $item->slug = Str::slug($data['name']) . '-' . time();
                $item->service = $data['service'] ?? "0";
                $item->user_id = $user->id;
                $item->save();

                // save product images if any
                if (isset($data['productImages'])) {
                    foreach ($data['productImages'] as $productImage) {
                        // Set the item_id for each image
//                        logger()->info("product image", (array)$productImage);
                        logger()->info("product image item_id", (array)$item->id);
                        $productImage->item_id = $item->id;
                        $productImage->save();
                    }
                }

                $item->save();
                return $item;
            });
            return new ProductResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function update($slug, $data)
    {
        # code...
        // validate data and save to database
        try {
            //code...
            $record = DB::transaction(function () use ($slug, $data) {
                $item = Product::whereSlug($slug)->first();
                if ($item == null) {
                    throw new Exception("Item to be updated does not exist");
                }
                $item->update($data);
                return $item;
            });
            return new ProductResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * delete a record in database
     */
    public function delete($slug): bool
    {
        try {
            // validate data and save to database
            $item = Product::whereSlug($slug)->first();
            if ($item == null) {
                throw new Exception("Item to be deleted does not exist");
            }

            // delete the featured image
            if ($item->featured_image && File::exists(public_path($item->featured_image))) {
                File::delete(public_path($item->featured_image));
            }

            // delete the item images
            foreach ($item->images as $image) {
                if ($image->image && File::exists(public_path($image->image))) {
                    File::delete(public_path($image->image));
                }
                $image->delete();
            }

            $item->delete();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}