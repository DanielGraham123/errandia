<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller {

    public function products(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $data['title'] = "All Products";
        $data['products'] = Product::orderBy('id', 'DESC')->get();
        return view('admin.products.index', $data);
    }

    public function show_product(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        # code...
        $data['title'] = "Create New Product";
        return view('admin.products.show', $data);
    }

//    public function create_products(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
//    {
//        # code...
//        $data['title'] = "Create New Product";
//        return view('admin.products.create', $data);
//    }

    public function save_products(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        # code...
        $validity = Validator::make($request->all(), [
            'name'=>'required', 'category'=>'required', 'shop'=>'required',
            'unit_price'=>'required', 'description'=>'required', 'status'=>'required',
            'quantity'=>'required', 'service'=>'required', 'search_index'=>'required',
            'tags'=>'required', 'category_id'=>'required', 'images'=>'required',
            'user_id'=>'required'
        ]);

        if($validity->fails()){
            return back()->with('error', $validity->errors()->first())->withInput();
        }

        $product = new Product();

        $product_data = ['name'=>$request->name, 'shop_id'=>$request->shop, 'unit_price'=>$request->unit_price, 'description'=>$request->description,  'user_id'=>auth('admin')->id(),  'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
            'status'=>$request->status, 'quantity'=>$request->quantity, 'service'=>$request->service, 'search_index'=>$request->search_index, 'tags'=>$request->tags, 'category_id'=>$request->category_id, 'images'=>$request->images
        ];
        if(Product::where(['name'=>$request->name])->count() > 0){
            return redirect(route('admin.products.index'))->with('error', 'Product with same name already exist');
        }
        // SAVE PRODUCT DATA
        $product->fill($product_data);
        if(($file = $request->file('featured_image')) != null){
            $path = public_path('uploads/products/');
            $fname = 'product_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $product->featured_image = $fname;
        }
        $product->save();
        return redirect(route('admin.products.index'))->with('success', 'Product created successfully');
    }

    public function services(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        # code...
        $data['title'] = "All Services";
        return view('admin.services.index', $data);
    }

    public function show_service(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        # code...
        $data['title'] = "Service Details";
        return view('admin.services.show', $data);
    }

    public function create_service(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        # code...
        $data['title'] = "Create New Services";
        return view('admin.services.create', $data);
    }

}
