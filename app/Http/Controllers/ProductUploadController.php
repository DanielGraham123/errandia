<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductUploadController extends Controller
{
    const PRODUCT_IMAGE_PATH = "uploads/products/";

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function uploadProductGallery(Request $request, $id)
    {
        $image = time().'.'.$request['image']->extension();
        $product = Product::find($id);
        $saveImage = ProductImage::create([
            'item_id'       => $product->id,
            'image'         =>  self::PRODUCT_IMAGE_PATH.'/'.$product->name.'/images/'.$image,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        $request['image']->move(public_path(self::PRODUCT_IMAGE_PATH.'/'.$product->name.'/images/'), $image);

        return response()->json(['image' => $saveImage]);
    }

    public function removeProductImage(Request $request, $product_id)
    {
        $image = time().'.'.$request['image']->extension();
        $product = Product::find($product_id);
        $productImage = self::PRODUCT_IMAGE_PATH.'/'.$product->name.'/images/'.$image;
        $deleted = ProductImage::where('item_id', $product->id)->where('image', $productImage)->first()->delete();

        return response()->json(['msg' => $deleted]);
    }

    public function addItemImage(Request $request, $slug)
    {
        try {
            $authenticatedUser = auth('api')->user();

            $item = $this->productService->getBySlug($slug);

            if (!$this->is_owner($item, $authenticatedUser)) {
                return $this->build_response(
                    response(),
                    'You are not authorized to update this product/service.',
                    403
                );
            }

            $savedImage = $this->productService->addItemImage($request, $item);

            return $this->build_success_response(
                response(),
                'image uploaded',
                [
                    'image' => $savedImage
                ]
            );
        } catch (\Exception $e) {
            logger()->error('error uploading image', (array)$e->getMessage());
            return $this->build_error_response(
               $e->getMessage(), 'error uploading image', 400
            );
        } catch (\Throwable $th) {
            logger()->error('error uploading image', (array)$th);
            return $this->build_error_response(
                $th->getMessage(), 'error uploading image', 400
            );
        }
    }

    public function removeItemImage(Request $request, $slug)
    {
        try {
            $authenticatedUser = auth('api')->user();

            $item = $this->productService->getBySlug($slug);

            if (!$this->is_owner($item, $authenticatedUser)) {
                return $this->build_response(
                    response(),
                    'You are not authorized to delete this product/service.',
                    403
                );
            }

            $deleted = $this->productService->removeItemImage($request, $item);

            return $this->build_success_response(
                response(),
                'image deleted',
                [
                    'image' => $deleted
                ]
            );
        } catch (\Exception $e) {
            logger()->error('error deleting image', (array)$e->getMessage());
            return $this->build_error_response(
               $e->getMessage(), 'error deleting image', 400
            );
        } catch (\Throwable $th) {
            logger()->error('error deleting image', (array)$th);
            return $this->build_error_response(
                $th->getMessage(), 'error deleting image', 400
            );
        }
    }

    public function removeAllItemImages(Request $request, $slug)
    {
        try {
            $authenticatedUser = auth('api')->user();

            $item = $this->productService->getBySlug($slug);

            if (!$this->is_owner($item, $authenticatedUser)) {
                return $this->build_response(
                    response(),
                    'You are not authorized to perform this action.',
                    403
                );
            }

            $deleted = $this->productService->removeAllItemImages($request, $item);

            return $this->build_success_response(
                response(),
                'images deleted',
                [
                    'images' => $deleted
                ]
            );
        } catch (\Exception $e) {
            logger()->error('error deleting images', (array)$e->getMessage());
            return $this->build_error_response(
               $e->getMessage(), 'error deleting images', 400
            );
        } catch (\Throwable $th) {
            logger()->error('error deleting images', (array)$th);
            return $this->build_error_response(
                $th->getMessage(), 'error deleting images', 400
            );
        }
    }
}
