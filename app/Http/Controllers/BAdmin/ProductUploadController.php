<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductUploadController extends Controller
{
    const PRODUCT_IMAGE_PATH = "uploads/products/";

    
    public function products(Request $request){
        $user = auth()->user();
        $action = $request->action;
        $data['shop'] = $request->shop_slug == null? null : Shop::whereSlug($request->shop_slug)->first();
        $products = $data['shop'] == null ? Product::whereIn('shop_id', $user->shops()->pluck('id')->toArray())->where('service', 0) : $products = $data['shop']->products();

        switch ($action) {
            case 'all':
                $data['products'] = $products->get();
                break;
            
            case 'published':
                $data['products'] = $products->where('status', 1)->get();
                break;
            
            case 'draft':
                $data['products'] = $products->where('status', 0)->get();
                break;
            
            case 'trash':
                $data['products'] = $products->whereNotNull('deleted_at')->get();
                break;
            
            default:
                $data['products'] = $products->get();
                break;
        }
        return view('b_admin.products.index', $data);
    }

    public function create_products($slug){
        $user = auth()->user();
        $data['shop'] = Shop::whereSlug($slug)->first();
        // $data['currencies'] = Currency::all();
        return view('b_admin.products.create', $data);
    }

    public function save_products(Request $request, $slug){

        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['shop'] = Shop::whereSlug($slug)->first();

        // return view('b_admin.products.create_categ_images', $data);
        switch ($request->step??null) {
            case '1':
                $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required', 'image'=>'required|file']);
                if($validity->fails()){
                    return back()->withInput(request()->all())->with('error', $validity->errors()->first());
                }

                $data['categories'] = SubCategory::orderBy('name')->get();

                // save product
                $item = ['name'=>$request->name, 'shop_id'=>$data['shop']->id, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 'service'=>false, 'tags' => $request->tags];
                
                if(($file = $request->file('image')) != null){
                    $path = public_path('uploads/item_images/');
                    $fname = 'prod_'.time().'_'.random_int(10000, 99999).'.'.$file->getClientOriginalExtension();
                    
                    $file->move($path, $fname);
                    // dd($fname);
                    $fpathname = $fname;
                    $item['featured_image'] = $fpathname;
                }

                $unique_check = ['name'=>$request->name, 'shop_id'=>$data['shop']->id, 'service'=>false];
                if(($product_instance = Product::where($unique_check)->first()) == null){
                    $product_instance = new Product($item);
                    $product_instance->save();
                }
                if($product_instance->featured_image != null){
                    if(ProductImage::where(['item_id'=>$product_instance->id, 'image'=>$product_instance->featured_image])->count() == 0){
                        ProductImage::insert(['item_id'=>$product_instance->id, 'image'=>$product_instance->featured_image]);
                    }
                }
                $data['item_id'] = $product_instance->id;

                //Update product images and categories 
                $data['item'] = $product_instance;
                $strx = $request->name.', '.$request->tags;

                $categs = explode(', ', $strx);

                $cats = collect();
                foreach ($categs as $key => $tok) {
                    # code...
                    $cats->push(SubCategory::where('name', 'LIKE', '% '.$tok.' %')->orWhere('description', 'LIKE', '%'.$tok.'%')->get());
                }
                // dd($cats);
                $guess = [];
                foreach ($cats as $key => $col) {
                    # code...
                    foreach ($col as $key => $elm) {
                        # code...
                        $guess[] = $elm;
                    }
                }
                
                $data['proposed_categories'] = $guess;
                $data['categories'] = SubCategory::orderBy('name')->get();
                $data['step'] = 2;
                return view('b_admin.products.create', $data);
                break;
            
            case '2':
                // dd($request->all());
                $validity = Validator::make($request->all(), ['categories'=>'required']);
                if($validity->fails()){
                    session()->flash('error', $validity->errors()->first());
                    return back()->withInput();
                }
                $product = Product::whereSlug($request->item_slug)->first();
                if($product != null){
                    $product_categories = [];
                    foreach ($request->categories as $key => $cat) {
                        # code...
                        $product_categories[] = ['item_id'=>$product->id, 'sub_category_id'=>$cat];
                    }
                    ItemCategory::insert($product_categories);
                    $data['item'] = $product;
                    $data['step'] = 3;
                    // dd($data);
                    return view('b_admin.products.create', $data);

                }else{
                    return back()->withInput();
                }
                break;

            case '3':
                $validity = Validator::make($request->all(), ['unit_price'=>'required', 'description'=>'required']);
                if($validity->fails()){
                    return back()->withInput(request()->all())->with('error', $validity->errors()->first());
                }
                $product = Product::whereSlug($request->item_slug)->first();
                $update = ['unit_price'=> $request->unit_price, 'description'=>nl2br($request->description), 'status'=>1];
                if($product != null){
                    $biz = $data['shop'];
                    if($biz != null && $biz->contactInfo != null){
                        $bizIndex = ($biz->contactInfo->street->town->region->country->name??null).'_'.($biz->contactInfo->street->town->region->name??null).'_'.($biz->contactInfo->street->town->name??null).'_'.($biz->contactInfo->street->name??null).'_'.($biz->name??null).'_'.implode('_', $biz->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $biz->subCategories->pluck('description')->toArray() ?? []);
                        $prodIndex = $product->name.'_'.str_replace(',', '_', $product->tags).'_'.implode('_', $product->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $product->subCategories->pluck('description')->toArray() ?? []);
                        $index = $bizIndex.'_'.$prodIndex;
                        $update['search_index'] = $index;
                    }
                    $product->update($update);
                }

                // dd($request->all());
                if (($files = $request->file('gallery')) != null) {
                    # code...
                    $item_images = [];
                    foreach ($files as $key => $file) {
                        # code...
                        $path = public_path('uploads/item_images');
                        $fname = 'img_'.time().random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
                        $file->move($path, $fname);
                        $item_images[] = ['item_id'=>$product->id, 'image'=>$fname];
                    }
                    ProductImage::insert($item_images);
                }

                // save product images if need be
                break;
            default:
                # code...
                break;
        }
        
        return redirect(route('business_admin.products.index', $data['shop']->slug));
    }

    public function save_service(Request $request, $slug){

        $data['shop'] = Shop::whereSlug($slug)->first();
        switch ($request->step??null) {
            case '1':
                
                $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required']);
                if($validity->fails()){
                    return back()->withInput(request()->all())->with('error', $validity->errors()->first());
                }

                $data['categories'] = SubCategory::orderBy('name')->get();

                // save product
                $item = ['name'=>$request->name, 'shop_id'=>$data['shop']->id, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 'service'=>true, 'tags' => $request->tags];
                if(($file = $request->file('image')) != null){
                    $path = public_path('uploads/item_images/');
                    $fname = 'prod_'.time().'_'.random_int(10000, 99999).'.'.$file->getClientOriginalExtension();
                    
                    $file->move($path, $fname);
                    // dd($fname);
                    $fpathname = $fname;
                    $item['featured_image'] = $fpathname;
                }

                $unique_check = ['name'=>$request->name, 'shop_id'=>$data['shop']->id, 'service'=>true];
                if(($product_instance = \App\Models\Product::where($unique_check)->first()) == null){
                    $product_instance = new \App\Models\Product($item);
                    $product_instance->save();

                    if($product_instance->featured_image != null){
                        ProductImage::insert(['item_id'=>$product_instance->id, 'image'=>$product_instance->featured_image]);
                    }
                }
                $data['item_id'] = $product_instance->id;

                //Update product images and categories 
                $data['item'] = $product_instance;
                $strx = $request->name.', '.$request->tags;

                $categs = explode(', ', $strx);

                $cats = collect();
                foreach ($categs as $key => $tok) {
                    # code...
                    $cats->push(\App\Models\SubCategory::where('name', 'LIKE', '% '.$tok.' %')->orWhere('description', 'LIKE', '%'.$tok.'%')->get());
                }
                // dd($cats);
                $guess = [];
                foreach ($cats as $key => $col) {
                    # code...
                    foreach ($col as $key => $elm) {
                        # code...
                        $guess[] = $elm;
                    }
                }
                
                $data['proposed_categories'] = $guess;
                $data['categories'] = SubCategory::orderBy('name')->get();
                $data['step'] = 2;
                return view('b_admin.services.create', $data);
                break;
            
            case '2':
                // dd($request->all());
                $validity = Validator::make($request->all(), ['categories'=>'required']);
                if($validity->fails()){
                    return back()->withInput(request()->all())->with('error', $validity->errors()->first());
                }
                $product = \App\Models\Product::whereSlug($request->item_slug)->first();
                if($product != null){
                    $product_categories = [];
                    foreach ($request->categories as $key => $cat) {
                        # code...
                        $product_categories[] = ['item_id'=>$product->id, 'sub_category_id'=>$cat];
                    }
                    \App\Models\ItemCategory::insert($product_categories);
                    $data['item'] = $product;
                    $data['step'] = 3;
                    // dd($data);
                    return view('b_admin.services.create', $data);

                }else{
                    return back()->withInput();
                }
                break;

            case '3':
                $validity = Validator::make($request->all(), ['description'=>'required']);
                if($validity->fails()){
                    return back()->withInput(request()->all())->with('error', $validity->errors()->first());
                }
                $product = Product::whereSlug($request->item_slug)->first();
                $update = ['unit_price'=> $request->unit_price??'', 'description'=>nl2br($request->description), 'status'=>1];
                if($product != null){
                    $biz = $data['shop'];
                    if($biz != null && $biz->contactInfo != null){
                        $bizIndex = ($biz->contactInfo->street->town->region->country->name??null).'_'.($biz->contactInfo->street->town->region->name??null).'_'.($biz->contactInfo->street->town->name??null).'_'.($biz->contactInfo->street->name??null).'_'.($biz->name??null).'_'.implode('_', $biz->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $biz->subCategories->pluck('description')->toArray() ?? []);
                        $prodIndex = $product->name.'_'.str_replace(',', '_', $product->tags).'_'.implode('_', $product->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $product->subCategories->pluck('description')->toArray() ?? []);
                        $index = $bizIndex.'_'.$prodIndex;
                        $update['search_index'] = $index;
                    }
                    $product->update($update);
                }

                // save product images if need be
                if (($files = $request->file('gallery')) != null) {
                    # code...
                    $item_images = [];
                    foreach ($files as $key => $file) {
                        # code...
                        $path = public_path('uploads/item_images');
                        $fname = 'img_'.time().random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
                        $file->move($path, $fname);
                        $item_images[] = ['item_id'=>$product->id, 'image'=>$fname];
                    }
                    ProductImage::insert($item_images);
                }

            }
        return redirect()->route('business_admin.services.index', $slug);
    }

    public function edit_products($slug){
        $user = auth()->user();
        $data['product'] = Product::whereSlug($slug)->first();
        $data['title'] = "Product Update";
        return view('b_admin.products.edit', $data);
    }

    public function edit_service($slug){
        $user = auth()->user();
        $data['product'] = Product::whereSlug($slug)->first();
        $data['title'] = "Service Update";
        return view('b_admin.services.edit', $data);
    }

    public function update_products(Request $request, $slug){

        try {
            //code...
            $product = Product::whereSlug($slug)->first();
            $data['categories'] = SubCategory::orderBy('name')->get();
            $data['product'] = $product;
    
            // return view('b_admin.products.create_categ_images', $data);
            switch ($request->step??null) {
                case '1':
                    $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required']);
                    if($validity->fails()){
                        return back()->withInput( array_merge(request()->all(), ['error'=> $validity->errors()->first()]));
                    }
                    DB::beginTransaction();
                    
                    $data['categories'] = SubCategory::orderBy('name')->get();
                    
                    // save product
                    $item = ['name'=>$request->name, 'tags' => $request->tags];
                    
                    if(($file = $request->file('image')) != null){
                        $path = public_path('uploads/item_images/');
                        $fname = 'prod_'.time().'_'.random_int(10000, 99999).'.'.$file->getClientOriginalExtension();
                        
                        $file->move($path, $fname);
                        // dd($fname);
                        $fpathname = $fname;
                        $item['featured_image'] = $fpathname;
                    }
                    // dd($request->all());
    
                    $unique_check = ['name'=>$request->name, 'shop_id'=>$product->shop_id, 'service'=>false];
                    if((Product::where($unique_check)->where('slug', '!=', $slug)->first()) == null){
                        $product->update($item);
                    }
                    if(in_array('featured_image', $item)){
                        if(ProductImage::where(['item_id'=>$product->id, 'image'=>$item['featured_image']])->count() == 0){
                            ProductImage::insert(['item_id'=>$product->id, 'image'=>$item['featured_image']]);
                        }
                    }
                    $data['item_id'] = $product->id;
    
                    //Update product images and categories 
                    $data['item'] = $product;
                    $strx = $request->name.', '.$request->tags;
    
                    $categs = explode(', ', $strx);
    
                    $cats = collect();
                    foreach ($categs as $key => $tok) {
                        # code...
                        $cats->push(\App\Models\SubCategory::where('name', 'LIKE', '% '.$tok.' %')->orWhere('description', 'LIKE', '%'.$tok.'%')->get());
                    }
                    // dd($cats);
                    $guess = [];
                    foreach ($cats as $key => $col) {
                        # code...
                        foreach ($col as $key => $elm) {
                            # code...
                            $guess[] = $elm;
                        }
                    }
                    
                    $data['proposed_categories'] = $guess;
                    $data['categories'] = \App\Models\SubCategory::orderBy('name')->get();
                    $data['step'] = 2;
                    DB::commit();
                    return view('b_admin.products.edit', $data);
                    break;
                
                case '2':
                    // dd($request->all());
                    $validity = Validator::make($request->all(), ['categories'=>'required']);
                    if($validity->fails()){
                        session()->flash('error', $validity->errors()->first());
                        return back()->withInput();
                    }

                    if($product != null){
                        DB::beginTransaction();
                        $product_categories = [];
                        foreach ($request->categories as $key => $cat) {
                            # code...
                            $product_categories[] = ['item_id'=>$product->id, 'sub_category_id'=>$cat];
                        }
                        \App\Models\ItemCategory::where('item_id', $product->id)->each(function($row){$row->delete();});
                        \App\Models\ItemCategory::insert($product_categories);
                        $data['item'] = $product;
                        $data['step'] = 3;
                        DB::commit();
                        // dd($data);
                        return view('b_admin.products.edit', $data);
    
                    }else{
                        return back()->withInput();
                    }
                    break;
    
                case '3':
                    $validity = Validator::make($request->all(), ['unit_price'=>'required', 'description'=>'required']);
                    if($validity->fails()){
                        return back()->withInput(request()->all())->with('error', $validity->errors()->first());
                    }
                    DB::beginTransaction();
                    $product = \App\Models\Product::whereSlug($request->item_slug)->first();
                    $update = ['unit_price'=> $request->unit_price, 'description'=>nl2br($request->description), 'status'=>1];
                    if($product != null){
                        $biz = $product->shop;
                        if($biz != null && $biz->contactInfo != null){
                            $bizIndex = ($biz->contactInfo->street->town->region->country->name??null).'_'.($biz->contactInfo->street->town->region->name??null).'_'.($biz->contactInfo->street->town->name??null).'_'.($biz->contactInfo->street->name??null).'_'.($biz->name??null).'_'.implode('_', $biz->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $biz->subCategories->pluck('description')->toArray() ?? []);
                            $prodIndex = $product->name.'_'.str_replace(',', '_', $product->tags).'_'.implode('_', $product->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $product->subCategories->pluck('description')->toArray() ?? []);
                            $index = $bizIndex.'_'.$prodIndex;
                            $update['search_index'] = $index;
                        }
                        $product->update($update);
                    }
    
                    // dd($request->all());
                    if (($files = $request->file('gallery')) != null) {
                        # code...
                        $item_images = [];
                        foreach ($files as $key => $file) {
                            # code...
                            $path = public_path('uploads/item_images');
                            $fname = 'img_'.time().random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
                            $file->move($path, $fname);
                            $item_images[] = ['item_id'=>$product->id, 'image'=>$fname];
                        }
                        \App\Models\ProductImage::insert($item_images);
                    }
                    DB::commit();
                    // save product images if need be
                    break;
                default:
                    # code...
                    break;
            }
            
            return redirect(route('business_admin.products.index', $product->shop->slug));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', "File____{$th->getFile()}____Line____{$th->getLine()}_____Message____{$th->getMessage()}");
        }
    }

    public function update_service(Request $request, $slug){

        try {
            //code...
            $product = Product::whereSlug($slug)->first();
            $data['categories'] = SubCategory::orderBy('name')->get();
            $data['product'] = $product;
    
            // return view('b_admin.products.create_categ_images', $data);
            switch ($request->step??null) {
                case '1':
                    $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required']);
                    if($validity->fails()){
                        return back()->withInput( array_merge(request()->all(), ['error'=> $validity->errors()->first()]));
                    }
                    DB::beginTransaction();
                    
                    $data['categories'] = SubCategory::orderBy('name')->get();
                    
                    // save product
                    $item = ['name'=>$request->name, 'tags' => $request->tags];
                    
                    if(($file = $request->file('image')) != null){
                        $path = public_path('uploads/item_images/');
                        $fname = 'prod_'.time().'_'.random_int(10000, 99999).'.'.$file->getClientOriginalExtension();
                        
                        $file->move($path, $fname);
                        // dd($fname);
                        $fpathname = $fname;
                        $item['featured_image'] = $fpathname;
                    }
                    // dd($request->all());
    
                    $unique_check = ['name'=>$request->name, 'shop_id'=>$product->shop_id, 'service'=>true];
                    if((Product::where($unique_check)->where('slug', '!=', $slug)->first()) == null){
                        $product->update($item);
                    }
                    if(in_array('featured_image', $item)){
                        if(ProductImage::where(['item_id'=>$product->id, 'image'=>$item['featured_image']])->count() == 0){
                            ProductImage::insert(['item_id'=>$product->id, 'image'=>$item['featured_image']]);
                        }
                    }
                    $data['item_id'] = $product->id;
    
                    //Update product images and categories 
                    $data['item'] = $product;
                    $strx = $request->name.', '.$request->tags;
    
                    $categs = explode(', ', $strx);
    
                    $cats = collect();
                    foreach ($categs as $key => $tok) {
                        # code...
                        $cats->push(\App\Models\SubCategory::where('name', 'LIKE', '% '.$tok.' %')->orWhere('description', 'LIKE', '%'.$tok.'%')->get());
                    }
                    // dd($cats);
                    $guess = [];
                    foreach ($cats as $key => $col) {
                        # code...
                        foreach ($col as $key => $elm) {
                            # code...
                            $guess[] = $elm;
                        }
                    }
                    
                    $data['proposed_categories'] = $guess;
                    $data['categories'] = \App\Models\SubCategory::orderBy('name')->get();
                    $data['step'] = 2;
                    DB::commit();
                    return view('b_admin.products.edit', $data);
                    break;
                
                case '2':
                    // dd($request->all());
                    $validity = Validator::make($request->all(), ['categories'=>'required']);
                    if($validity->fails()){
                        session()->flash('error', $validity->errors()->first());
                        return back()->withInput();
                    }

                    if($product != null){
                        DB::beginTransaction();
                        $product_categories = [];
                        foreach ($request->categories as $key => $cat) {
                            # code...
                            $product_categories[] = ['item_id'=>$product->id, 'sub_category_id'=>$cat];
                        }
                        \App\Models\ItemCategory::where('item_id', $product->id)->each(function($row){$row->delete();});
                        \App\Models\ItemCategory::insert($product_categories);
                        $data['item'] = $product;
                        $data['step'] = 3;
                        DB::commit();
                        // dd($data);
                        return view('b_admin.products.edit', $data);
    
                    }else{
                        return back()->withInput();
                    }
                    break;
    
                case '3':
                    $validity = Validator::make($request->all(), ['unit_price'=>'required', 'description'=>'required']);
                    if($validity->fails()){
                        return back()->withInput(request()->all())->with('error', $validity->errors()->first());
                    }
                    DB::beginTransaction();
                    $product = \App\Models\Product::whereSlug($request->item_slug)->first();
                    $update = ['unit_price'=> $request->unit_price, 'description'=>nl2br($request->description), 'status'=>1];
                    if($product != null){
                        $biz = $product->shop;
                        if($biz != null && $biz->contactInfo != null){
                            $bizIndex = ($biz->contactInfo->street->town->region->country->name??null).'_'.($biz->contactInfo->street->town->region->name??null).'_'.($biz->contactInfo->street->town->name??null).'_'.($biz->contactInfo->street->name??null).'_'.($biz->name??null).'_'.implode('_', $biz->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $biz->subCategories->pluck('description')->toArray() ?? []);
                            $prodIndex = $product->name.'_'.str_replace(',', '_', $product->tags).'_'.implode('_', $product->subCategories->pluck('name')->toArray() ?? []).'_'.implode('_', $product->subCategories->pluck('description')->toArray() ?? []);
                            $index = $bizIndex.'_'.$prodIndex;
                            $update['search_index'] = $index;
                        }
                        $product->update($update);
                    }
    
                    // dd($request->all());
                    if (($files = $request->file('gallery')) != null) {
                        # code...
                        $item_images = [];
                        foreach ($files as $key => $file) {
                            # code...
                            $path = public_path('uploads/item_images');
                            $fname = 'img_'.time().random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
                            $file->move($path, $fname);
                            $item_images[] = ['item_id'=>$product->id, 'image'=>$fname];
                        }
                        \App\Models\ProductImage::insert($item_images);
                    }
                    DB::commit();
                    // save product images if need be
                    break;
                default:
                    # code...
                    break;
            }
            
            return redirect(route('business_admin.products.index', $product->shop->slug));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', "File____{$th->getFile()}____Line____{$th->getLine()}_____Message____{$th->getMessage()}");
        }
    }

    public function update_save_products(Request $request, $product)
    {
        $savedProduct = Product::findOrFail($product);
        $this->saveProductSubCategories($request->all()['categories'], $savedProduct);
        return redirect()->route("business_admin.products.index", ['shop_slug' => $savedProduct->shop->slug])->with("success", "Product Added Successfully");
    }

    public function services(Request $request, $slug=null){
        $user = auth()->user();
        $action = $request->action;
        $data['shop'] = $request->shop_slug == null? null : Shop::whereSlug($request->shop_slug)->first();
        $products = $data['shop'] == null ? Product::whereIn('shop_id', $user->shops()->pluck('id')->toArray())->where('service', 1) : $products = $data['shop']->services();

        switch ($action) {
            case 'all':
                $data['products'] = $products->get();
                break;
            
            case 'published':
                $data['products'] = $products->where('status', 1)->get();
                break;
            
            case 'draft':
                $data['products'] = $products->where('status', 0)->get();
                break;
            
            case 'trash':
                $data['products'] = $products->whereNotNull('deleted_at')->get();
                break;
            
            default:
                $data['products'] = $products->get();
                break;
        }
        return view('b_admin.services.index', $data);
    }
    
    public function create_service($slug){
        $user = auth()->user();
        $data['shop'] = Shop::whereSlug($slug)->first();
        // $data['currencies'] = Currency::all();
        return view('b_admin.services.create', $data);
    }

    public function update_save_service(Request $request, $slug)
    {
        dd($request->all());
    }

    public function show_product($slug)
    {
        $item = Product::whereSlug($slug)->first();
        $data['item'] = $item;
        $reviews = $item->reviews();
        $_reviews_sum = $item->reviews()->sum('rating');
        $reviews_sum = $_reviews_sum == 0 ? 1 : $_reviews_sum;
        $reviews_count = $reviews->count() == 0 ? 1 : $reviews->count();
        $data['average_rating'] = round($reviews->sum('rating')/$reviews_count);
        $data['rating5'] = round(($item->reviews()->where('rating', 5)->sum('rating')/$reviews_sum)*100);
        $data['rating4'] = round(($item->reviews()->where('rating', 4)->sum('rating')/$reviews_sum)*100);
        $data['rating3'] = round(($item->reviews()->where('rating', 3)->sum('rating')/$reviews_sum)*100);
        $data['rating2'] = round(($item->reviews()->where('rating', 2)->sum('rating')/$reviews_sum)*100);
        $data['rating1'] = round(($item->reviews()->where('rating', 1)->sum('rating')/$reviews_sum)*100);

        $reported = \App\Models\ReviewReport::pluck('review_id')->toArray();
        $data['reviews'] = $item->reviews()->whereNotIn('id', $reported)->get();

        $data['shop_reviews'] = $item->shop->items()->join('reviews', 'reviews.item_id', '=', 'items.id')->count();
        // dd($data);
        return view('public.products.show', $data);
    }

    public function unpublish_products(Request $request, $product_slug)
    {
        $product = Product::whereSlug($product_slug)->first();
        if($product != null){
            if($request->has('pb') and $request->pb == 1)
                $product->update(['status'=>0]);
            else
                $product->update(['status'=>1]);

        }
        return $product->service != 1 ?
            redirect()->route('business_admin.products.index', $product->shop->slug)->with('success', "Operation complete") :
            redirect()->route('business_admin.services.index', $product->shop->slug)->with('success', "Operation complete") ;
    }

    
}
