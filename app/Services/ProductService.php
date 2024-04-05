<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService{

    private $productRepository;
    private $validationService;
    public function __construct(ProductRepository $productRepository,
                                ValidationService $validationService){
        $this->productRepository = $productRepository;
        $this->validationService = $validationService;
    }

    /**
     * @throws \Exception
     */
    public function getAll($category_id = null, $service = null)
    {
        # code...
        return $this->productRepository->get($category_id, $service);
    }

    public function getAllPaginate($page_size, $current_page, $category_id = null, $service = null)
    {
        # code...
        $products = $this->productRepository->get($page_size, $category_id, $service);
        $items = array_slice($products->resolve(), ($current_page-1)*$page_size, $page_size);
        $pagination = new LengthAwarePaginator($items, $products->count(), $page_size, $current_page);
        return $pagination;
    }

    /**
     * @throws \Throwable
     */
    public function getBySlug($slug): ProductResource
    {
        return $this->productRepository->getBySlug($slug);
    }

    public function save($data, $request)
    {
        // TODO: not working -> buggy
        if (isset($data['featured_image']) && ($file = $data['featured_image']) != null) {
            $data['featured_image'] = $this->uploadImage($file, 'products');
        }

        if (isset($data['images']) && is_array($data['images'])) {
            $images = [];
            foreach ($data['images'] as $image) {
                $imagePath = $this->uploadImage($image, 'products');
                $productImage = new ProductImage(['image' => $imagePath]);
                $images[] = $productImage;
            }
            $data['productImages'] = $images; // Use a different key to store images
        }
        return $this->productRepository->store($data);
    }

    private function uploadImage($file, $folder)
    {
        $path = public_path("uploads/$folder/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fName = $folder . '_' . time() . '_' . random_int(1000, 9999) . '.' . $file->getClientOriginalExtension();
        $file->move($path, $fName);

        return "uploads/$folder/$fName";
    }

    public function getUserProducts($user)
    {
        return $this->productRepository->getUserProducts($user);
    }

    public function getUserServices($user)
    {
        return $this->productRepository->getUserServices($user);
    }

    public function update_item($request, $item)
    {
        $data = $request->except(['featured_image']);
        foreach ($data as $key => $value) {
            if ($request->has($key)) {
                $item->$key = $value;
            }
        }

        // if the featured_image is set, upload the image and the item already has image delete it
        if ($request->hasFile('featured_image')) {
            logger()->info('featured_image found in request'. $request->file('featured_image'));
            if (!empty($item->featured_image)) {
                MediaService::delete_media($item->featured_image);
            }
            $item->featured_image = MediaService::upload_media($request, 'featured_image', 'products');
            $data['featured_image'] = $item->featured_image;

            logger()->info('feature image replaced ' . $item->featured_image);
        }

        $item->update($data);
        $item->refresh();

        $elSearchService =  ElasticSearchProductService::init();
        $elSearchService->update_document($item->id, $item);
        return $item;
    }

    /**
     * @throws \Throwable
     */
    public function addItemImage($request, $item): ProductImage
    {
        $data = $request->all();
        if (isset($data['image']) && ($file = $data['image']) != null) {
            $item['image'] = $this->uploadImage($file, 'products');
            logger()->info('Image uploaded for product: ' . $item['image']);

        }

        return $this->productRepository->addItemImage($item);
    }

    /**
     * @throws \Throwable
     */
    public function removeItemImage($request, $item): bool
    {
        return $this->productRepository->removeItemImage($request, $item);
    }

    /**
     * @throws \Throwable
     */
    public function removeAllItemImages($request, $item): bool
    {
        return $this->productRepository->removeAllItemImages($item);
    }

    public function deleteFeaturedImage($item)
    {
        if(empty($item->featured_image)) {
            logger()->info("item info: " . json_encode($item));
            throw new \Exception('No image to delete');
        }

        MediaService::delete_media($item->featured_image);

        $item->featured_image = null;
        $item->save();

        return $item;
    }

    /**
     * @throws \Throwable
     */
    public function delete($slug): bool
    {
        return $this->productRepository->delete($slug);
    }

}