<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductImageUploadController extends Controller
{
    const PRODUCT_IMAGE_PATH = "uploads/products/";

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
}
