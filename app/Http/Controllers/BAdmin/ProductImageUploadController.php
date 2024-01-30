<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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


    
    public function product_photos($product_slug)
    {
        # code...
        $product = Product::whereSlug($product_slug)->first();
        $data['product'] = $product;
        $data['title'] = $product->service != 1 ? "Manage Product Images For {$product->name}" : "Manage Service Images For {$product->name}";
        return view('b_admin.products.images', $data);
    }

    public function update_product_photos(Request $request, $product_slug)
    {
        # code...
        // dd($request->all());
        $validity = Validator::make($request->all(), ['images'=>'array', 'saved'=>'array']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }
        
        $product = Product::whereSlug($product_slug)->first();
        $dropped_images = $product->images()->whereNotIn('id', $request->saved??[])->get();
        if($dropped_images != null){
            foreach ($dropped_images as $key => $image) {
                unlink(public_path('uploads/item_images/').$image->image);
                $image->delete();
            }
        }
        if(($new_images = $request->file('images')) != null){
            $prod_images = [];
            foreach ($new_images as $key => $img) {
                $fname = "prod{$product->id}_".time()."_".random_int(1000000, 9999999).'.'.$img->getClientOriginalExtension();
                $img->move(public_path('uploads/item_images/'), $fname);
                $prod_images[] = ['item_id'=>$product->id, 'image'=>$fname];
            }
            ProductImage::insert($prod_images);
        }
        return redirect()->route('business_admin.products.show', $product_slug)->with('success', 'Operation complete');
    }
}
