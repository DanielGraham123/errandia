<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Manager;
use App\Models\Product;
use App\Models\Region;
use App\Models\Shop;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function home(){
        return view('manager.dashboard');
    }

    public function businesses(){
        $shops = auth('manager')->user()->shops;
        $data['businesses'] = $shops;
        return view('manager.businesses.index', $data);
    }

    public function create_business(){
        $data['user'] = auth('manager')->user();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('manager.businesses.create', $data);
    }

    public function create_business_branch($slug){
        $data['user'] = auth('manager')->user();
        $data['parent'] = Shop::whereSlug($slug)->first();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('manager.businesses.branches.create', $data);
    }

    
    public function save_business(Request $request){
        
        $validity = Validator::make($request->all(), [
            'town'=>'required', 'street'=>'required', 'website'=>'url|nullable',
            'name'=>'required', 'category'=>'required', 'region'=>'required', 
            'phone'=>'required|integer', 'phone_code'=>'required_with:phone', 
            'whatsapp_phone'=>'integer|nullable', 'email'=>'email|nullable',
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 
            'fb_link'=>'url|nullable', 'ins_link'=>'url|nullable',
        ]);

        if($validity->fails()){
            return back()->with('error', $validity->errors()->first())->withInput();
        }
        
        $business = new \App\Models\Shop();
        $data = [
            'name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description, 'region_id'=>$request->region, 'user_id'=>auth('manager')->id(), 
            'town_id'=>$request->town, 'street_id'=>$request->street, 'website'=>$request->website, 'phone'=>$request->phone_code.$request->phone, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
            'whatsapp_phone'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'email'=>$request->email, 'status'=>0, 'is_branch'=>$request->is_branch,
            'fb_link'=>$request->fb_link, 'ins_link'=>$request->ins_link, 'manager_id'=>$request->manager, 'address'=>$request->address, 'parent_slug'=>$request->parent_slug??null
        ];
        if(Shop::where(['name'=>$request->name])->count() > 0){
            return redirect(route('admin.businesses.index'))->with('error', 'Business with same name already exist');
        }
        $business->fill($data);
        if(($file = $request->file('logo')) != null){
            $path = public_path('uploads/logos/');
            $fname = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $business->image_path = $path.$fname;
        }
        // dd($request->all());
        $business->save();
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
            return back()->with('error', $validity->errors()->first())->withInput();
        }
        
        $parent = Shop::whereSlug($slug)->first();
        if(($parent->street_id == $request->street) && ($parent->address == $request->address)){
            return back()->with('error', 'You already have a branch of this business in the specified location with the same address.');
        }
        $business = new \App\Models\Shop();
        $data = [
            'name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description, 'region_id'=>$request->region, 'user_id'=>auth('manager')->id(), 
            'town_id'=>$request->town, 'street_id'=>$request->street, 'website'=>$request->website, 'phone'=>$request->phone_code.$request->phone, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
            'whatsapp_phone'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'email'=>$request->email, 'status'=>$request->status, 'is_branch'=>$request->is_branch,
            'fb_link'=>$request->fb_link, 'ins_link'=>$request->ins_link, 'manager_id'=>$request->manager, 'address'=>$request->address, 'parent_slug'=>$request->parent_slug??null
        ];

        // if(Shop::where(['name'=>$request->name])->count() > 0){
        //     return back()->with('error', 'Business with same name already exist');
        // }
        $business->fill($data);
        if(($file = $request->file('logo')) != null){
            $path = public_path('uploads/logos/');
            $fname = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $business->image_path = $path.$fname;
        }
        // dd($request->all());
        $business->save();
        return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
    }


    public function edit_business($slug){
        $data['business'] = Shop::whereSlug($slug)->first();
        if($data['business'] != null){
            $data['title'] = "Edit Business";
            $data['categories'] = SubCategory::orderBy('name')->get();
            $data['regions'] = Region::orderBy('name')->get();
            $data['towns'] = Town::orderBy('name')->get();
            $data['streets'] = Street::orderBy('name')->get();
            return view('admin.businesses.edit', $data);
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
            return back()->with('error', $validity->errors()->first());
        }

        $business = \App\Models\Shop::whereSlug($slug)->first();

        if($business != null){
            $data = [
                'name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description, 'region_id'=>$request->region, 'user_id'=>auth('manager')->id(), 
                'town_id'=>$request->town, 'street_id'=>$request->street, 'website'=>$request->website, 'phone'=>$request->phone_code.$request->phone, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
                'whatsapp_phone'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'email'=>$request->email, 'type'=>$request->business_type, 'status'=>$request->verification_status, 
            ];
            if(Shop::where(['name'=>$request->name])->where('slug', '!=', $slug)->count() > 0){
                return redirect(route('admin.businesses.index'))->with('error', 'Business with same name already exist');
            }
            $business->fill($data);
            
            $business->save();
            return redirect(route('admin.businesses.index'))->with('success', 'Business successfully created');
        }
        return redirect(route('admin.businesses.index'))->with('error', 'Business not found');
    }


    public function managers(){
        $data['managers'] = auth('manager')->user()->managers;
        return view('manager.businesses.managers.index', $data);
    }

    public function create_manager(Request $request){
        $data['user'] = auth('manager')->user();
        $data['businesses'] = $data['user']->shops;
        return view('manager.businesses.managers.create', $data);
    }


    public function save_manager(Request $request){
        // dd($request->all());
        $validity = Validator::make($request->all(), [
            'name'=>'required', 'email'=>'email|required',
            'confirm_password'=>'required|min:6', 'password'=>'required|same:confirm_password'
        ]);

        if($validity->fails()){
            return back()->with('error', $validity->errors()->first())->withInput();
        }

        if(Manager::where(['email'=>$request->email])->count() > 0){
            return back()->with('error', "A manager already exist with this email");
        }
        $data = ['name'=>$request->name, 'email'=>$request->email, 'password'=>Hash::make($request->password), 'user_id'=>auth('manager')->id(), 'slug'=>'mana'.random_bytes(12).'ger'.random_int(1000000, 9999999)];
        $instance = new Manager($data);
        $instance->save();

        return redirect(route('business_admin.managers.index'))->with('success', 'Manager successfully created.');
    }


    public function business_branches($slug){
        $business = Shop::whereSlug($slug)->first();
        $data['business'] = $business;
        $data['branches'] = $business->branches()->get();
        return view('manager.businesses.branches.index', $data);
    }


    


    public function enquiries(){
        $data['enquiries'] = [];
        return view('manager.enquiries.index', $data);
    }


    public function show_enquiry(Request $request, $slug){
        return view('manager.enquiries.create');
    }

    public function products(Request $request){
        $user = auth('manager')->user();

        if($request->shop_slug == null)
            $data['products'] = Product::whereIn('shop_id', $user->shops()->pluck('id')->toArray())->get();
        else {
            $data['shop'] = Shop::whereSlug($request->shop_slug)->first();
            $data['products'] = $data['shop']->products??[];
        }
        return view('manager.products.index', $data);
    }

    public function create_products($slug){
        $user = auth('manager')->user();
        $data['shop'] = Shop::whereSlug($slug)->first();
        $data['currencies'] = Currency::all();
        return view('manager.products.create', $data);
    }

    public function save_products(Request $request, $slug){

        $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required', 'image'=>'required', 'description'=>'required']);
        if($validity->fails()){
            return back()->withInput(request()->all())->with('error', $validity->errors()->first());
        }
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['shop'] = Shop::whereSlug($slug)->first();

        return view('manager.products.create_categ_images', $data);
    }

    public function update_save_products(Request $request, $slug)
    {
        dd($request->all());
    }

    public function services(Request $request, $slug=null){
        $user = auth('manager')->user();
        if($request->shop_slug == null)
            $data['products'] = Product::whereIn('shop_id', $user->shops()->pluck('id')->toArray())->where('is_service', 1)->get();
        else {
            $data['shop'] = Shop::whereSlug($request->shop_slug)->first();
            $data['products'] = $data['shop']->products->where('is_service', 1)??[];
        }
        return view('manager.services.index', $data);
    }

    
    public function create_service($slug){
        $user = auth('manager')->user();
        $data['shop'] = Shop::whereSlug($slug)->first();
        $data['currencies'] = Currency::all();
        return view('manager.services.create', $data);
    }

    
    public function save_service(Request $request, $slug){

        $validity = Validator::make($request->all(), ['name'=>'required', 'tags'=>'required', 'image'=>'required', 'description'=>'required']);
        if($validity->fails()){
            return back()->withInput(request()->all())->with('error', $validity->errors()->first());
        }
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['shop'] = Shop::whereSlug($slug)->first();

        return view('manager.services.create_categ_images', $data);
    }


    
    public function update_save_service(Request $request, $slug)
    {
        dd($request->all());
    }


    public function errands(Request $request){
        $data['errands'] = \App\Models\Errand::take(100)->get();
        return view('manager.errands.index', $data);
    }

    public function create_errand(){
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('manager.errands.create', $data);
    }

    public function save_errand(Request $request){
        // save and forward errand for image update
        $data['errand'] = $request->all();
        $data['categories'] = SubCategory::orderBy('name')->get();
        return view('manager.errands.create_categ_images', $data);
    }

    public function update_save_errand(Request $request){
        // save and forward errand for image update
        return back()->with('success', 'Done');
    }

    public function show_errand ($slug){
        $data['errand'] = \App\Models\Errand::whereSlug($slug)->first();
        return view('manager.errands.show', $data);
    }

    public function edit_errand($slug){
        $data['errand'] = \App\Models\Errand::whereSlug($slug)->first();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('manager.errands.edit', $data);
    }

    public function update_errand($slug){
        $data['errand'] = \App\Models\Errand::whereSlug($slug)->first();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('manager.errands.edit', $data);
    }
}
