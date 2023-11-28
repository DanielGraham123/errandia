<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    const PRODUCT_IMAGE_PATH = "uploads/products/";

    public function test(Request $request)
    {
        $image = time().'.'.$request['image']->extension;
        $product_id = Session::get('product');
        $product = Product::find($product_id);
        ProductImage::create([
            'item_id'       => $product->id,
            'image'         =>  self::PRODUCT_IMAGE_PATH.'/'.$product->name.'/images/'.$image,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        $request['image']->move(public_path(self::PRODUCT_IMAGE_PATH.'/'.$product->name.'/images/'), $image);

        return response()->json(['msg' => $request->all()]);
    }
}
