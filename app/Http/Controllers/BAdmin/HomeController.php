<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Errand;
use App\Models\ErrandImage;
use App\Models\ItemCategory;
use App\Models\ItemSubCategory;
use App\Models\Manager;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Region;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\ShopContactInfo;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class HomeController extends Controller
{
    const PRODUCT_IMAGE_PATH = "uploads/products/";
    public function home(){
        // dd(1231231230);
        $data['statistics'] = [
            'errands'=>auth()->user()->errands()->count(),
            'shops'=>auth()->user()->shops()->count(),
            'products'=>auth()->user()->shops()->join('items', 'items.shop_id', '=', 'shops.id')->where('items.status', 1)->where('service', 0)->count(),
            'services'=>auth()->user()->shops()->join('items', 'items.shop_id', '=', 'shops.id')->where('items.status', 1)->where('service', 1)->count(),
            'enquiries'=>00
        ];
        return view('b_admin.dashboard', $data);
    }

    public function businesses(){
        $shops = Shop::join('shop_managers', 'shop_managers.shop_id', '=', 'shops.id')->where('shop_managers.user_id', auth()->id())->select('shops.*')->get();
        if(request('action') == 'trash')
            $data['businesses'] = $shops->where('deleted_at', '!=', null)->all();
        else
            $data['businesses'] = $shops->where('deleted_at', null)->all();
        return view('b_admin.businesses.index', $data);
    }

    public function create_business(){
        $data['user'] = auth()->user();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('b_admin.businesses.create', $data);
    }

    public function create_business_branch($slug){
        $data['user'] = auth()->user();
        $data['parent'] = Shop::whereSlug($slug)->first();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('b_admin.businesses.branches.create', $data);
    }

    public function save_business(Request $request){
        
        $validity = Validator::make($request->all(), [
            'name'=>'required', 'region'=>'required', 
            'town'=>'required', 'street'=>'required', 'website'=>'url|nullable',
            'phone'=>'required|integer', 'phone_country_code'=>'required_with:phone', 
            'whatsapp_country_code'=>'required_with:whatsapp', 'whatsapp'=>'integer|nullable', 'email'=>'email|nullable',
        ]);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        $business = new \App\Models\Shop();


        $shop_data = ['name'=>$request->name, 'description'=>$request->description,  'user_id'=>auth()->id(),  'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
                    'status'=>1 ];
        if(Shop::where(['name'=>$request->name])->count() > 0){
            session()->flash('error', 'Business with same name already exist');
            return back()->withInput();
        }
        // SAVE BUSINESS DATA
        $business->fill($shop_data);
        if(($file = $request->file('image')) != null){
            $path = public_path('uploads/logos/');
            $fname = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $business->image_path = $fname;
        }
        $business->save();

        // SAVE BUSINESS CONTACT INFO
        $contact_data = ['shop_id'=>$business->id, 'address'=>$request->address??'', 'street_id'=>$request->street, 'phone_country_code'=>$request->phone_country_code??'', 'phone'=>$request->phone, 'whatsapp_country_code'=>$request->whatsapp_country_code, 'whatsapp'=>$request->whatsapp, 'website'=>$request->website, 'email'=>$request->email];
        \App\Models\ShopContactInfo::updateOrInsert(['shop_id'=>$business->id], $contact_data);
        
        // SET DEFAULT BUSINESS MANAGER
        $manager_data = ['shop_id'=>$business->id, 'user_id'=>auth()->id(), 'is_owner'=>true, 'status'=>true];
        \App\Models\ShopManager::updateOrInsert(['shop_id'=>$business->id, 'user_id'=>auth()->id()], $manager_data);

        return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
    }
 
    public function save_business_branch(Request $request, $slug){
        
        $validity = Validator::make($request->all(), [
            'town'=>'required', 'street'=>'required', 'website'=>'url|nullable',
            'name'=>'required', 'region'=>'required', 
            'phone'=>'required|integer', 'phone_country_code'=>'required_with:phone', 
            'whatsapp'=>'integer|nullable', 'email'=>'email|nullable',
            'whatsapp_country_code'=>'required_with:whatsapp', 
            'fb_link'=>'url|nullable', 'ins_link'=>'url|nullable',
        ]);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }
        
        $parent = Shop::whereSlug($slug)->first();
        if(($parent->street_id == $request->street) && ($parent->address == $request->address)){
            session()->flash('error', 'You already have a branch of this business in the specified location with the same address.');
            return back()->withInput();
        }
        $business = new \App\Models\Shop();
        $shop_data = ['name'=>$request->name, 'description'=>$request->description, 'user_id'=>auth()->id(), 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
        'status'=>$request->status, 'is_branch'=>true, 'parent_slug'=>$request->parent_slug??null];

        // if(Shop::where(['name'=>$request->name])->count() > 0){
        //     return back()->with('error', 'Business with same name already exist');
        // }
        $business->fill($shop_data);
        if(($file = $request->file('image')) != null){
            $path = public_path('uploads/logos/');
            $fname = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $business->image_path = $fname;
        }
        // dd($request->all());
        $business->save();

        // SAVE BUSINESS CONTACT INFO
        $contact_data = ['shop_id'=>$business->id, 'address'=>$request->address??'', 'street_id'=>$request->street, 'phone_country_code'=>$request->phone_country_code, 'phone'=>$request->phone, 'whatsapp_country_code'=>$request->whatsapp_country_code, 'whatsapp'=>$request->whatsapp, 'website'=>$request->website, 'email'=>$request->email];
        \App\Models\ShopContactInfo::updateOrInsert(['shop_id'=>$business->id], $contact_data);
        
        // SET DEFAULT BUSINESS MANAGER
        $manager_data = ['shop_id'=>$business->id, 'user_id'=>auth()->id(), 'is_owner'=>true, 'status'=>true];
        \App\Models\ShopManager::updateOrInsert(['shop_id'=>$business->id, 'user_id'=>auth()->id()], $manager_data);

        return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
    }

    public function edit_business($slug){
        $data['shop'] = Shop::whereSlug($slug)->first();
        if($data['shop'] != null){
            $data['title'] = "Edit Business";
            $data['categories'] = SubCategory::orderBy('name')->get();
            $data['regions'] = Region::orderBy('name')->get();
            $data['towns'] = Town::orderBy('name')->get();
            $data['streets'] = Street::orderBy('name')->get();
            return view('b_admin.businesses.edit', $data);
        }
    }

    public function update_business(Request $request, $slug){
        
        $validity = Validator::make($request->all(), [
            'name'=>'required', 'region'=>'required', 
            'town'=>'required', 'street'=>'required', 'website'=>'url',
            'is_branch'=>'required', 'phone'=>'required|integer',
             'phone_country_code'=>'required_with:phone', 
             'whatsapp'=>'integer|nullable', 'whatsapp_country_code'=>'required_with:whatsapp', 'email'=>'email',
        ]);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        $business = \App\Models\Shop::whereSlug($slug)->first();

        if($business != null){
            
            $shop_data = ['name'=>$request->name, 'description'=>$request->description,  'user_id'=>auth()->id(),  'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
                    'status'=>false, ];
            if(Shop::where(['name'=>$request->name])->where('slug', '!=', $slug)->count() > 0){
                session()->flash('error', 'Business with same name already exist');
                return redirect(route('business_admin.businesses.index'))->withInput();
            }
            $business->update($shop_data);

            // SET CONTACT INFO
            $contact_data = ['shop_id'=>$business->id, 'address'=>$request->address??'', 'street_id'=>$request->street, 'phone_country_code'=>$request->phone_country_code, 'phone'=>$request->phone, 'whatsapp_country_code'=>$request->whatsapp_country_code, 'whatsapp'=>$request->whatsapp, 'website'=>$request->website, 'email'=>$request->email];
            \App\Models\ShopContactInfo::updateOrInsert(['shop_id'=>$business->id], $contact_data);
            
            // SET DEFAULT BUSINESS MANAGER
            $manager_data = ['shop_id'=>$business->id, 'user_id'=>auth()->id(), 'is_owner'=>true, 'status'=>true];
            \App\Models\ShopManager::updateOrInsert(['shop_id'=>$business->id, 'user_id'=>auth()->id()], $manager_data);
            
            return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
        }
        return redirect(route('business_admin.businesses.index'))->with('error', 'Business not found');
    }

    public function show_business ($slug){
        $data['shop'] = Shop::whereSlug($slug)->first();
        $data['branches'] = $data['shop']->branches()->get();
        $data['regions'] = Region::orderBy('name')->get();
        $data['categories'] = Category::orderBy('name')->get();
        $data['shop_subcats'] = $data['shop']->subCategories;
        $data['all_sub_categories'] = SubCategory::orderBy('name')->get();
        $data['managers'] = $data['shop']->managers;
        // dd($data);
        return view('b_admin.businesses.show', $data);
    }

    public function managers($shop_slug){
        $shop = Shop::whereSlug($shop_slug)->first();
        $data['title'] = "Managers of ".$shop->name;
        $data['shop'] = $shop;
        $data['managers'] = $shop->managers;
        return view('b_admin.businesses.managers.index', $data);
    }


    public function business_branches($slug){
        $business = Shop::whereSlug($slug)->first();
        $data['business'] = $business;
        $data['branches'] = $business->branches()->get();
        return view('b_admin.businesses.branches.index', $data);
    }


    


    public function enquiries(){
        $data['enquiries'] = [];
        return view('b_admin.enquiries.index', $data);
    }

    public function show_enquiry(Request $request, $slug){
        return view('b_admin.enquiries.create');
    }

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
        $shop = Shop::whereSlug($slug)->first();
        $data['shop'] = $shop;
        $data['title'] = "Update Business Categories";
        $data['scats'] = SubCategory::orderBy('name')->get();
        $data['biz_cats'] = $shop->subCategories()->pluck('sub_categories.id')->toArray();
        if(count($data['biz_cats']) == 0){
            $data['action'] = "Next";
            $data['info'] = "Shops must have atleast a category to post a product/service";
            return view('b_admin.businesses.categories.update', $data);
        }
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

        if(($user = auth()->user()) != null){
            if($user->photo == null){
                session()->flash('error', 'Profile photo not set. Please update profile and try again.');
                return back()->withInput();
            }
        }
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
        $shop = Shop::whereSlug($slug)->first();
        $data['shop'] = $shop;
        $data['title'] = "Update Business Categories";
        $data['scats'] = SubCategory::orderBy('name')->get();
        $data['biz_cats'] = $shop->subCategories()->pluck('sub_categories.id')->toArray();
        if(count($data['biz_cats']) == 0){
            $data['action'] = "Next";
            $data['info'] = "Shops must have atleast a category to post a product/service";
            return view('b_admin.businesses.categories.update', $data);
        }
        // $data['currencies'] = Currency::all();
        return view('b_admin.services.create', $data);
    }



    
    public function update_save_service(Request $request, $slug)
    {
        dd($request->all());
    }

    public function errands(Request $request){
        $data['action'] = $request->action??null;
        if($request->action == 'posted'){
            $data['errands'] = \App\Models\Errand::where('user_id', auth()->id())->orderBy('id', 'DESC')->take(100)->get();
            $data['title'] = "Posted Errands";
        }else{
            $shops = auth()->user()->shops;

            // get categories of the current user's shops
            $shop_categories = [];
            foreach ($shops as $key => $shop) {
                # code...
                foreach ($shop->subCategories as $key => $subcat) {
                    # code...
                    $shop_categories[] = $subcat;
                }
            }
            $shop_category_ids = collect($shop_categories)->pluck('id')->toArray();
            $extra_ids = $shops->pluck('category_id')->toArray();
            $shop_category_ids = array_merge($shop_categories, $extra_ids);

            // get errands/quotes with matching categories
            $errands = [];
            foreach ($shop_category_ids as $key => $sci) {
                # code...
                $_errands = \App\Models\Errand::where('sub_categories', 'LIKE', '%'.$sci.'%')->where('read_status', 0)->where('status', 1)->where('user_id', '!=', auth()->id())
                    ->orderBy('id', 'DESC')->take(50)->get();
                foreach ($_errands as $key => $err) {
                    # code...
                    $errands[] = $err;
                }
            }
            $data['errands'] = collect($errands)->shuffle()->take(100);
            $data['title'] = "Recieved Errands";
            // dd($shop_category_ids);
            // dd($errands);
        }
        return view('b_admin.errands.index', $data);
    }

    public function create_errand(){
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('b_admin.errands.create', $data);
    }

    public function save_errand(Request $request){
        // save and forward errand for image update
        $request->validate(['title'=>'required']);
        $data['errand'] = $request->all();
        $data['title'] = "Post Errand";
        $item = ['title'=>$request->title, 'region_id'=>$request->region??null, 'town_id'=>$request->town??null, 'street_id'=>$request->street??null, 'description'=>$request->description, 'user_id'=>auth()->id(), 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre'];
        // $unique_check = ['title'=>$request->title, 'region_id'=>$request->town, 'town_id'=>$request->town, 'street_id'=>$request->street, 'description'=>$request->description, 'user_id'=>auth()->id()];
        // if(($instance = \App\Models\Errand::where($unique_check)->first()) == null){
        // }
        $instance = new \App\Models\Errand($item);
        $instance->save();

        $data['quote'] = $instance;
        // Propose categories
        $title = $request->title;
        $tokens = explode(' ', $title);

        $props = [];
        foreach ($tokens as $key => $tok) {
            $props[] = \App\Models\SubCategory::where('name', 'LIKE', '%'.$tok.'%')->orWhere('description', 'LIKE', '%'.$tok.'%')->get()->all();
        }
        $categs = [];
        foreach ($props as $key => $prop) {
            foreach ($prop as $key => $prp) {
                # code...
                $categs[] = $prp;
            }
        }
        $data['proposed_categories'] = array_unique($categs);
        // dd($categs);
        $data['categories'] = SubCategory::orderBy('name')->get();
        return view('b_admin.errands.create_categ_images', $data);
    }

    public function update_save_errand(Request $request){
        // save and forward errand for image update
        $request->validate(['categories'=>'required|array', 'visibility'=>'required', 'quote_slug'=>'required']);
        
        $quote = Errand::whereSlug($request->quote_slug)->first();
        $quote->sub_categories = implode(',', $request->categories);
        $quote->visibility = $request->visibility;
        $quote->status = 1;
        $quote->save();

        if(($gallery = $request->file('images')) != null){
            $quote_images = [];
            $count = 0;
            foreach ($gallery as $key => $file) {
                # code...
                if ($count >= 3) {break;}
                $path = public_path('uploads/quote_images');
                $fname = 'qim_'.time().'_'.random_int(100000, 999999).'.'.$file->getClientOriginalExtension();
                $file->move($path, $fname);
                $quote_images[] = ['item_quote_id'=>$quote->id, 'image'=>$fname];
                $count++;
            }
            ErrandImage::insert($quote_images);
            $quote->update(['status'=>1]);
        }
        return redirect()->route('business_admin.errands.index');
    }

    public function show_errand ($slug){
        $data['errand'] = \App\Models\Errand::whereSlug($slug)->first();
        return view('b_admin.errands.show', $data);
    }

    public function edit_errand($slug){
        $data['errand'] = \App\Models\Errand::whereSlug($slug)->first();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('b_admin.errands.edit', $data);
    }

    public function update_errand($slug){
        $data['errand'] = \App\Models\Errand::whereSlug($slug)->first();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('b_admin.errands.edit', $data);
    }


    public function create_manager($shop_slug)
    {
        # code...
        $data['shop'] = Shop::whereSlug($shop_slug)->first();
        $data['title'] = "Add Manager To ".$data['shop']->name??'';
        return view('b_admin.businesses.managers.create', $data);
    }

    public function send_manager_request ($shop_slug, $user_id)
    {
        # code...
        $shop_id = Shop::whereSlug($shop_slug)->first()->id;
        $data = ['shop_id'=>$shop_id, 'user_id'=>$user_id, 'status'=>0];
        \App\Models\ShopManager::updateOrInsert(['shop_id'=>$shop_id, 'user_id'=>$user_id], ['status'=>0]);
        return redirect()->route('business_admin.managers.index', $shop_slug);
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

    

    public function delete_business($slug)
    {
        $shop = shop::whereSlug($slug)->first();
        if($shop != null){
            if($shop->user_id == auth()->id()){
                $shop->delete();
                return back()->with('success', "Operation complete");
            }
            else
                return back()->with('error', "Permission Denied");
        }
    }
    

    public function suspend_business($slug)
    {
        $shop = shop::whereSlug($slug)->first();
        if($shop != null){
            if($shop->user_id == auth()->id()){
                $shop->update(['status'=>!$shop->status]);
                return back()->with('success', "Operation complete");
            }
            else
                return back()->with('error', "Permission Denied");
        }
    }
    

    public function set_errand_found($slug)
    {
        $errand = Errand::whereSlug($slug)->first();
        if($errand != null){
            if($errand->user_id == auth()->id()){
                $shop->update(['status'=>abs(1-$shop->status)]);
                return back()->with('success', "Operation complete");
            }
            else
                return back()->with('error', "Permission Denied");
        }
    }


    public function refresh_errand($slug)
    {
        $errand = Errand::whereSlug($slug)->first();
        if($errand->read_status == 1){
            $errand->update(['read_status'=>0]);
        }
        return back()->with('success', 'Operation complete');
    }


    public function delete_errand($slug)
    {
        $errand = Errand::whereSlug($slug)->first();
        if(!$errand == null){
            $errand->delete();
            return redirect()->route('business_admin.errands.index', ['action'=>'posted'])->with('success', 'Operation complete');
        }
    }

    public function subscriptions()
    {
        # code...
        $data['title'] = "My Subscriptions";
        $data['shops'] = auth()->user()->shops;
        $data['plans'] = \App\Models\Subscription::all();
        $data['subscriptions'] = \App\Models\ShopSubscription::whereIn('shop_id', auth()->user()->shops()->pluck('id')->toArray())->orderBy('subscription_date', 'DESC')->get();
        return view('b_admin.subscriptions.index', $data);

    }
    
    public function save_subscription(Request $request)
    {
        # code...
        // return $request->all();
        $validity = Validator::make($request->all(), ['shop_id'=>'required', 'payment_method'=>'required', 'subscription_id'=>'required', 'account_number'=>'required']);

        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        try{
            $plan = Subscription::find($request->subscription_id);
            if($plan != null){
                
                $transaction_id = $this->momoService->makePayments(['account_number'=>$request->account_number, 'amount'=>$plan->amount]);
                if($transaction_id != null){
                    // Create a pending subscription
                    $instance = new \App\Models\ShopSubscription(['shop_id'=>$request->shop_id, 'subscription_id'=>$request->subscription_id, 'subscription_date'=>now(), 'expiration_date'=>now()->addDays($plan->duration??0)]);
                    $instance->payment_id = $transaction_id;
                    $instance->save();
                    return back()->with('success', 'Suscription initialized. Awaiting payment.');
                }
            }
    
            // Make payment and update subscription record
    
            return back()->with('error', "Failed to initialize subscription. Try again later");
        }catch(Throwable $th){
            return back()->with('error', $th->getMessage());
        }
    }

    public function follow_business($slug)
    {
        # code...
        $business = \App\Models\Shop::whereSlug($slug)->first();
        if($business != null){
            if(\App\Models\ShopSubscriber::where(['user_id'=>auth()->id(), 'shop_id'=>$business->id])->count() == 0){
                (new \App\Models\ShopSubscriber(['user_id'=>auth()->id(), 'shop_id'=>$business->id]))->save();
                return redirect()->route('public.business.show', $slug)->with('success', "Operation completed");
            }else{
                return redirect()->route('public.business.show', $slug)->with('message', "Already a subsriber");
            }
        }
        return redirect()->route('public.business.show', $slug)->with('error', "Failed to identify business");            
    }

    public function unfollow_business($slug)
    {
        # code...
        $business = \App\Models\Shop::whereSlug($slug)->first();
        if($business != null){
            if(\App\Models\ShopSubscriber::where(['user_id'=>auth()->id(), 'shop_id'=>$business->id])->count() > 0){
                \App\Models\ShopSubscriber::where(['user_id'=>auth()->id(), 'shop_id'=>$business->id])->each(function($row){
                    $row->delete();
                });
                return redirect()->route('public.business.show', $slug)->with('success', "Operation completed");
            }else{
                return redirect()->route('public.business.show', $slug)->with('message', "Not a subsriber");
            }
        }
        return redirect()->route('public.business.show', $slug)->with('error', "Failed to identify business");
    }

    public function reviews()
    {
        # code...
        $shops = auth()->user()->shops();
        $reviews = [];
        if($shops->count() > 0 && count($items = \App\Models\Product::whereIn('shop_id', $shops->pluck('id')->toArray())->get()) != 0){
            $reviews = \App\Models\Review::whereIn('item_id', $items->pluck('id')->toArray())->get();
        }
        $data['title'] = "My Business Reviews";
        $data['reviews'] = $reviews;
        return view('b_admin.reviews.recieved', $data);
    }

    public function my_reviews()
    {
        # code...
        $data['title'] = "My Reviews";
        $data['reviews'] = \App\Models\Review::where('buyer_id', auth()->id())->get();
        return view('b_admin.reviews.sent', $data);
    }

    public function following()
    {
        # code...
        $data['title'] = "Businesses I Follow";
        $data['followings'] = \App\Models\ShopSubscriber::where('user_id', auth()->id())->get();
        return view('b_admin.following.sent', $data);
    }

    public function followers()
    {
        # code...
        $data['title'] = "My Subscribers";
        $data['followings'] = \App\Models\ShopSubscriber::whereIn('shop_id', auth()->user()->shops()->pluck('id')->toArray())->get();
        return view('b_admin.following.recieved', $data);
    }

    public function unfollow($id)
    {
        # code...
        if(($subs = \App\Models\ShopSubscriber::find($id)) != null){
            $subs->delete();
            return back()->with('success', "Operation completed");
        }
        return back()->with('error', 'Failed to unsubscribe. Try again later.');
    }

    public function edit_profile(){
        $data['title'] = "Update User Profile";
        $data['user'] = auth()->user();
        return view('b_admin.user_profile', $data);
    }

    public function update_profile(Request $request){
        $validity = Validator::make($request->all(), ['name'=>'required', 'email'=>'email', 'phone'=>'required', 'phone_country_code'=>'required']);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        auth()->user()->update(['name'=>$request->name, 'email'=>$request->email, 'phone'=>$request->phone, 'phone_country_code'=>$request->phone_country_code]);
        return back()->with('success', 'Operation Completed');
    }

    public function update_photo(Request $request)
    {
        # code...
        $validity = Validator::make($request->all(), ['image'=>'required|file']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        if(($file = $request->file('image')) !== null){
            $fname = '_user_'.auth()->id().'_'.time().random_int(10000, 99999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/user_photos'), $fname);
            $user = auth()->user();
            $user->photo = $fname;
            $user->save();
            return back()->with('success', 'Operation Complete');
        }
        return back()->with('error', 'No file selected');
    }

    public function update_business_contact(Request $request, $slug)
    {
        # code...
        $validity = Validator::make($request->all(), [
            'street'=>'required',
            'address'=>'required', 'whatsapp'=>'nullable', 'whatsapp_country_code'=>'required_with:whatsapp', 'phone'=>'nullable', 'phone_country_code'=>'required_with:phone',
            'email'=>'email', 'website'=>'url', 'facebook'=>'url', 'instagram'=>'url'
        ]);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }
        // dd($request->all());

        $shop = Shop::whereSlug($slug)->first();
        $contactInfo = $shop->contactInfo??null;
        if($contactInfo == null){
            ShopContactInfo::create([
                'shop_id'=>$shop->id, 'street_id'=>$request->street, 'address'=>$request->address, 
                'whatsapp'=>$request->whatsapp, 'phone'=>$request->phone, 
                'phone_country_code'=>$request->phone_country_code, 'whatsapp_country_code'=>$request->whatsapp_country_code,
                'email'=>$request->email, 'website'=>$request->website,
                'facebook'=>$request->facebook, 'instagram'=>$request->instagram
            ]);
            return back()->with('success', 'Operation Complete');
        }
        $contactInfo->update([
            'street_id'=>$request->street, 'address'=>$request->address, 
            'whatsapp'=>$request->whatsapp, 'phone'=>$request->phone,
            'phone_country_code'=>$request->phone_country_code, 'whatsapp_country_code'=>$request->whatsapp_country_code,
            'email'=>$request->email, 'website'=>$request->website,
            'facebook'=>$request->facebook, 'instagram'=>$request->instagram
        ]);
        return back()->with('success', 'Operation Complete');
    }

    public function edit_business_categories(Request $request, $slug)
    {
        # code...
        $data['title'] = "Update Business Categories";
        $data['scats'] = SubCategory::orderBy('name')->get();
        $data['shop'] = Shop::whereSlug($slug)->first();
        $data['biz_cats'] = $data['shop']->subCategories()->pluck('sub_categories.id')->toArray();
        return view('b_admin.businesses.categories.update', $data);
    }

    public function update_business_categories(Request $request, $slug)
    {
        # code...
        $validity = Validator::make($request->all(), ['sub_categories'=>'required|array']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        $shop = Shop::whereSlug($slug)->first();

        // dd($request->all());
        if($shop != null){
            // clear any existing shop categories
            $shop->subCategories()->each(function($rec)use($request){
                if(!in_array($rec->id, $request->sub_categories))
                    $rec->delete();
            });
    
            // save current sub categories
            $scats = [];
            foreach ($request->sub_categories as $key => $scat) {
                # code...
                if($shop->subCategories()->where(['sub_category_id'=>$scat, 'shop_id'=>$shop->id])->count() == 0)
                    $scats[] = ['sub_category_id'=>$scat, 'shop_id'=>$shop->id];
            }
            ShopCategory::insert($scats);
            return back()->with('success', 'Operation complete');
        }
        return back()->with('error', 'Operation failed. Failed to retrive shop');
    }

    public function update_business_profile(Request $request, $slug)
    {
        # code...
        $validity = Validator::make($request->all(), ['name'=>'required', 'description'=>'required']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        Shop::whereSlug($slug)->first()->update(['name'=>$request->name, 'description'=>$request->description]);
        return back()->with('success', 'operation complete');
    }
}