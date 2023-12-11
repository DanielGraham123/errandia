<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Errand;
use App\Models\ErrandImage;
use App\Models\ItemSubCategory;
use App\Models\Manager;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Region;
use App\Models\Shop;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    const PRODUCT_IMAGE_PATH = "uploads/products/";
    public function home(){
        // dd(1231231230);
        return view('b_admin.dashboard');
    }

    public function businesses(){
        $shops = Shop::join('shop_managers', 'shop_managers.shop_id', '=', 'shops.id')->where('shop_managers.user_id', auth()->id())->select('shops.*')->get();
        $data['businesses'] = $shops;
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
            'name'=>'required', 'category'=>'required', 'region'=>'required', 
            'town'=>'required', 'street'=>'required', 'website'=>'url|nullable',
            'phone'=>'required|integer', 'phone_code'=>'required_with:phone', 
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 'whatsapp_phone'=>'integer|nullable', 'email'=>'email|required',
        ]);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        $business = new \App\Models\Shop();


        $shop_data = ['name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description,  'user_id'=>auth()->id(),  'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
                    'status'=>false, ];
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
        $contact_data = ['shop_id'=>$business->id, 'address'=>$request->address??'', 'street_id'=>$request->street, 'phone'=>$request->phone_code.$request->phone, 'whatsapp'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'website'=>$request->website, 'email'=>$request->email];
        \App\Models\ShopContactInfo::updateOrInsert(['shop_id'=>$business->id], $contact_data);
        
        // SET DEFAULT BUSINESS MANAGER
        $manager_data = ['shop_id'=>$business->id, 'user_id'=>auth()->id(), 'is_owner'=>true, 'status'=>true];
        \App\Models\ShopManager::updateOrInsert(['shop_id'=>$business->id, 'user_id'=>auth()->id()], $manager_data);

        return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
    }
 
    public function save_business_branch(Request $request, $slug){
        
        $validity = Validator::make($request->all(), [
            'town'=>'required', 'street'=>'required', 'website'=>'url|nullable',
            'name'=>'required', 'category'=>'required', 'region'=>'required', 
            'phone'=>'required|integer', 'phone_code'=>'required_with:phone', 
            'whatsapp_phone'=>'integer|nullable', 'email'=>'email|nullable',
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 
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
        $data = [
            'name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description, 'region_id'=>$request->region, 'user_id'=>auth()->id(), 
            'town_id'=>$request->town, 'street_id'=>$request->street, 'website'=>$request->website, 'phone'=>$request->phone_code.$request->phone, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
            'whatsapp_phone'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'email'=>$request->email, 'status'=>$request->status, 'is_branch'=>$request->is_branch,
            'fb_link'=>$request->fb_link, 'ins_link'=>$request->ins_link, 'manager_id'=>$request->manager, 'address'=>$request->address, 'parent_slug'=>$request->parent_slug??null
        ];

        $shop_data = ['name'=>$request->name, 'description'=>$request->description, 'category_id'=>$request->category, 'user_id'=>auth()->id(), 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
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
        $contact_data = ['shop_id'=>$business->id, 'address'=>$request->address??'', 'street_id'=>$request->street, 'phone'=>$request->phone_code.$request->phone, 'whatsapp'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'website'=>$request->website, 'email'=>$request->email];
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
            'name'=>'required', 'category'=>'required', 'region'=>'required', 
            'town'=>'required', 'street'=>'required', 'website'=>'url',
            'business_type'=>'required', 'verification_status'=>'required', 'phone'=>'required|integer',
            //  'phone_code'=>'required_with:phone', 
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 'whatsapp_phone'=>'integer|nullable', 'email'=>'email|required',
        ]);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        $business = \App\Models\Shop::whereSlug($slug)->first();

        if($business != null){
            $data = [
                'name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description, 'region_id'=>$request->region, 'user_id'=>auth()->id(), 
                'town_id'=>$request->town, 'street_id'=>$request->street, 'website'=>$request->website, 'phone'=>$request->phone_code.$request->phone, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
                'whatsapp_phone'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'email'=>$request->email, 'type'=>$request->business_type, 'status'=>$request->verification_status, 
            ];
            if(Shop::where(['name'=>$request->name])->where('slug', '!=', $slug)->count() > 0){
                session()->flash('error', 'Business with same name already exist');
                return redirect(route('admin.businesses.index'))->withInput();
            }
            $business->fill($data);
            
            $business->save();
            return redirect(route('admin.businesses.index'))->with('success', 'Business successfully created');
        }
        return redirect(route('admin.businesses.index'))->with('error', 'Business not found');
    }

    public function show_business ($slug){
        $data['shop'] = Shop::whereSlug($slug)->first();
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
        $data['branches'] = $business->branches;
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

        if($request->shop_slug == null)
            $data['products'] = Product::whereIn('shop_id', $user->shops()->pluck('id')->toArray())->get();
        else {
            $data['shop'] = Shop::whereSlug($request->shop_slug)->first();
            $data['products'] = $data['shop']->products??[];
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

        $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required', 'image'=>'required', 'description'=>'required']);
        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['shop'] = Shop::whereSlug($slug)->first();

        return view('b_admin.products.create_categ_images', $data);
        switch ($request->step??null) {
            case '1':
                $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required']);
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
                if(($product_instance = \App\Models\Product::where($unique_check)->first()) == null){
                    $product_instance = new \App\Models\Product($item);
                    $product_instance->save();
                }
                if($product_instance->featured_image != null){
                    if(\App\Models\ProductImage::where(['item_id'=>$product_instance->id, 'image'=>$product_instance->featured_image])->count() == 0){
                        \App\Models\ProductImage::insert(['item_id'=>$product_instance->id, 'image'=>$product_instance->featured_image]);
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
                $data['categories'] = \App\Models\SubCategory::orderBy('name')->get();
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
                    \App\Models\ItemCategory::insert($product_categories);
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
                $product = \App\Models\Product::whereSlug($request->item_slug)->first();
                $update = ['unit_price'=> $request->unit_price, 'description'=>$request->description, 'status'=>1];
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
                    \App\Models\ProductImage::insert($item_images);
                }

                // save product images if need be
                break;
            default:
                # code...
                break;
        }
        
        return redirect(route('business_admin.products.index', $data['shop']->slug));
    }

    public function update_save_products(Request $request, $product)
    {
        $savedProduct = Product::findOrFail($product);
        $this->saveProductSubCategories($request->all()['categories'], $savedProduct);
        return redirect()->route("business_admin.products.index", ['shop_slug' => $savedProduct->shop->slug])->with("success", "Product Added Successfully");
    }

    public function services(Request $request, $slug=null){
        $user = auth()->user();
        if($request->shop_slug == null)
            $data['products'] = Product::whereIn('shop_id', $user->shops()->pluck('id')->toArray())->where('service', 1)->get();
        else {
            $data['shop'] = Shop::whereSlug($request->shop_slug)->first();
            $data['products'] = $data['shop']->services;
        }
        return view('b_admin.services.index', $data);
    }
    
    public function create_service($slug){
        $user = auth()->user();
        $data['shop'] = Shop::whereSlug($slug)->first();
        // $data['currencies'] = Currency::all();
        return view('b_admin.services.create', $data);
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
                $data['categories'] = \App\Models\SubCategory::orderBy('name')->get();
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
                $product = \App\Models\Product::whereSlug($request->item_slug)->first();
                $update = ['unit_price'=> $request->unit_price??'', 'description'=>$request->description, 'status'=>1];
                if($product != null){
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
                    \App\Models\ProductImage::insert($item_images);
                }

            }
        return view('b_admin.services.create_categ_images', $data);
    }


    
    public function update_save_service(Request $request, $slug)
    {
        dd($request->all());
    }

    public function errands(Request $request){
        if($request->type == null){
            $data['errands'] = \App\Models\Errand::where('user_id', auth()->id())->take(100)->get();
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
                $_errands = \App\Models\Errand::where('sub_categories', 'LIKE', '%'.$sci.'%')->where('read_status', 0)
                    ->inRandomOrder()->take(50)->get();
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
        $item = ['title'=>$request->title, 'region_id'=>$request->town??null, 'town_id'=>$request->town??null, 'street_id'=>$request->street??null, 'description'=>$request->description, 'user_id'=>auth()->id(), 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre'];
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
        $validator = Validator::make($request->all(), ['categories'=>'required|array', 'gallery'=>'required|array', 'visibility'=>'required', 'quote_slug'=>'required']);
        if($validator->fails()){
            session()->flash('error', $validator->errors()->first());
            return back()->withInput();
        }
        $quote = Errand::whereSlug($request->quote_slug)->first();
        $quote->sub_categories = implode(',', $request->categories);
        $quote->visibility = $request->visibility;
        $quote->status = 1;
        $quote->save();

        if(($gallery = $request->file('gallery')) != null){
            $quote_images = [];
            foreach ($gallery as $key => $file) {
                # code...
                $path = public_path('uploads/quote_images');
                $fname = 'qim_'.time().'_'.random_int(100000, 999999).'.'.$file->getClientOriginalExtension();
                $file->move($path, $fname);
                $quote_images[] = ['item_quote_id'=>$quote->id, 'image'=>$fname];
            }
            ErrandImage::insert($quote_images);
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
}
