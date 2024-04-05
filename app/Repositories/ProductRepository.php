<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Shop;
use App\Models\SubCategory;
use App\Services\ElasticSearchProductService;
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
        $items = Product::whereUserId($user->id)->whereService(0)->orderBy('created_at', 'desc')->paginate(15);
        return $items;

//       return Product::whereUserId($user->id)->paginate(15);
    }

    /**
     * get user services
     */
    public function getUserServices($user)
    {
        // return user products with is_services equals one
        $items = Product::whereUserId($user->id)->whereService(1)->orderBy('created_at', 'desc')->paginate(15);
        return $items;
    }

    /**
     * save a record to database
     */
    public function store($data)
    {
        $elSearchService =  ElasticSearchProductService::init();

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
        $category = SubCategory::find($data['category_id']);
        if ($category == null) {
            throw new Exception("Category does not exist");
        }

        // validate data and save to database
        try {
            $record = DB::transaction(function () use ($elSearchService, $data) {
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
                        logger()->info("product image item_id", (array)$item->id);
                        $productImage->item_id = $item->id;
                        $productImage->save();
                    }
                }

                $item->save();
                logger()->info("new item saved");
                $elSearchService->create_document($item->id, $item);
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
        try {

            $elSearchService =  ElasticSearchProductService::init();
            $record = DB::transaction(function () use ($slug, $data, $elSearchService) {
                $item = Product::whereSlug($slug)->first();
                if ($item == null) {
                    throw new Exception("Item to be updated does not exist");
                }
                $item->update($data);
                $elSearchService->update_document($item->id, $item);
                return $item;
            });
            return new ProductResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addItemImage($item)
    {
        try {

            $productImage = new ProductImage([
               'item_id' => $item->id,
               'image' => $item['image']
           ]);
              $productImage->save();
                return $productImage;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function removeItemImage($request, $item): bool
    {
        try {

            $imageId = $request->image_id;
            logger()->info('image_id: ' . $imageId);
            $itemImage = ProductImage::find($imageId);

            // check if image exists
            if ($itemImage == null) {
                throw new Exception("Image does not exist");
            }

            // check if the image belongs to the item
            if ($itemImage->item_id != $item->id) {
                throw new Exception("Image does not belong to the item");
            }

            // delete the image
            if ($itemImage->image && File::exists(public_path($itemImage->image))) {
                File::delete(public_path($itemImage->image));
            }
            $itemImage->delete();
            return true;


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function removeAllItemImages($item)
    {
        try {

            // delete the item images
            foreach ($item->images as $image) {
                if ($image->image && File::exists(public_path($image->image))) {
                    File::delete(public_path($image->image));
                }
                $image->delete();
            }
            return true;
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
            $this->removeAllItemImages($item);

            $item->delete();

            $elSearchService =  ElasticSearchProductService::init();
            $elSearchService->delete_document($item->id);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_item(mixed $item_id)
    {
        return Product::find($item_id);
    }
}