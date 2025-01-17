<?php


namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use App\Models\Errand;
use App\Models\File;
use App\Models\PrivacyPolicy;
use App\Models\Region;
use App\Models\Shop;
use App\Models\ShopSubscription;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\Town;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HomeController  extends Controller
{
    public function index()
    {

        $data['title'] = "Dashboard";
        return view('admin.dashboard', $data);
    }


    public function block_user($user_id)
    {
        # code...
        $user = User::find($user_id);
        if($user != null){
            $update = ['active'=>0, 'activity_changed_by'=>auth()->id(), 'activity_changed_at'=>now()->format(DATE_ATOM)];
            $user->update($update);
        }
        return back()->with('success', __('text.word_Done'));
    }

    public function activate_user($user_id)
    {
        # code...
        $user = User::find($user_id);
        if($user != null){
            $update = ['active'=>1, 'activity_changed_by'=>auth()->id(), 'activity_changed_at'=>now()->format(DATE_ATOM)];
            $user->update($update);
        }
        return back()->with('success', __('text.word_Done'));
    }

    public function errands(Request $reuest)
    {
        # code...
        $data['title'] = "Errands";
        $data['errands'] = Errand::paginate(100);
        // dd($data);
        return view('admin.errands.index', $data);
    }

    public function businesses(Request $reuest)
    {
        # code...
        $data['title'] = "Businesses";
        $data['businesses'] = Shop::orderBy('id', 'DESC')->get();
        return view('admin.businesses.index', $data);
    }

    public function business_branches(Request $reuest, $business_slug)
    {
        # code...
        $data['item'] = Shop::whereSlug($business_slug)->first();
        $data['title'] = "Businesses Branches For ".$data['item']->name;
        $data['businesses'] = $data['item']->branches()->orderBy('id', 'DESC')->get();
        return view('admin.businesses.branches.index', $data);
    }

    public function create_business(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Business";
        $data['categories'] = Category::orderBy('name')->get();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('admin.businesses.create', $data);
    }
    public function create_business_branch(Request $reuest, $business)
    {
        # code...
        $data['business'] = Shop::whereSlug($business)->first();
        if($data['business'] == null){
            return back()->with('error', "Business not found");
        }
        $data['title'] = "Create New Business Branch";
        $data['categories'] = Category::orderBy('name', 'DESC')->get();
        $data['regions'] = Region::orderBy('name', 'DESC')->get();
        $data['towns'] = Town::orderBy('name', 'DESC')->get();
        $data['streets'] = Street::orderBy('name', 'DESC')->get();
        return view('admin.businesses.branches.create', $data);
    }
    public function show_business(Request $reuest, $business = null)
    {
        # code...
        $data['title'] = "Business Details";
        return view('admin.businesses.show', $data);
    }

    public function products(Request $reuest)
    {
        # code...
        $data['title'] = "All Products";
        return view('admin.products.index', $data);
    }


    public function create_products(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Product";
        return view('admin.products.create', $data);
    }

    public function show_product(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Product";
        return view('admin.products.show', $data);
    }

    public function services(Request $reuest)
    {
        # code...
        $data['title'] = "All Services";
        return view('admin.services.index', $data);
    }

    public function show_service(Request $reuest)
    {
        # code...
        $data['title'] = "Service Details";
        return view('admin.services.show', $data);
    }

    public function create_service(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Services";
        return view('admin.services.create', $data);
    }
    
    public function categories (Request $reuest)
    {
        # code...
        $data['title'] = "All Categories";
        $data['categories'] = \App\Models\Category::all();
        return view('admin.categories.index', $data);
    }

    public function create_category(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Category";
        return view('admin.categories.create', $data);
    }

    public function sub_categories(Request $reuest)
    {
        # code...
        $data['title'] = "All Sub-Categories";
        $data['sub_categories'] = SubCategory::all();
        return view('admin.categories.subcategories.index', $data);
    }

    public function create_sub_category(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Sub-Category";
        $data['categories'] = Category::all();
        return view('admin.categories.subcategories.create', $data);
    }

    public function towns(Request $reuest)
    {
        # code...
        $data['title'] = "All Towns";
        $data['towns'] = Town::orderBy('id', 'DESC')->get();
        return view('admin.towns.index', $data);
    }

    public function streets(Request $reuest)
    {
        # code...
        $data['title'] = "All Streets";
        $data['streets'] = Street::orderBy('id', 'DESC')->get();
        return view('admin.streets.index', $data);
    }

    public function create_town(Request $reuest)
    {
        # code...
        $data['title'] = "Create Town";
        $data['regions'] = Region::all();
        return view('admin.towns.create', $data);
    }

    public function create_street(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Street";
        $data['towns'] = Town::all();
        return view('admin.streets.create', $data);
    }

    public function reviews(Request $reuest)
    {
        # code...
        $data['title'] = "All Reviews";
        // $data['reviews'] = Town::all();
        return view('admin.streets.create', $data);
    }

    public function subscription_plans (Request $reuest)
    {
        # code...
        $data['title'] = "All Subscription Plans";
        $data['plans'] = Subscription::all();
        return view('admin.subscriptions.index', $data);
    }

    public function create_subscription_plan (Request $reuest)
    {
        # code...
        $data['title'] = "Add New Subscription Plan";
        return view('admin.subscriptions.create', $data);
    }

    public function save_subscription_plan (Request $request)
    {
        # code...
        // dd($request->all());

        $validity = Validator::make($request->all(), ['name'=>'required', 'amount'=>'required|numeric', 'duration'=>'required']);
        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        $data = ['name'=>$request->name, 'amount'=>$request->amount, 'duration'=>$request->duration, 'currency'=>$request->currency??'XAF', 'description'=>$request->description??''];
        if(Subscription::where(['name'=>$request->name, 'amount'=>$request->amoun, 'duration'=>$request->duration])->count() > 0){
            session()->flash('error', 'Plan already exist');
            return back()->withInput();
        }

        $instance = new Subscription($data);
        $instance->save();

        return redirect()->route('admin.plans.index');
    }

    

    public function subscription_report (Request $reuest)
    {
        # code...
        $data['title'] = "All Subscriptions";
        $data['subscriptions'] = ShopSubscription::all();
        return view('admin.reports.subscriptions', $data);
    }

    public function delete_errand($errand_slug){
        $errand = Errand::whereSlug($errand_slug)->first();
        if($errand != null){
            $errand->delete();
            return back()->with('success', 'Successfully deleted');
        }
        return back()->with('error', 'Errand not found');
    }

    public function save_town(Request $request){
        $validity = Validator::make($request->all(), ['name'=>'required', 'region_id'=>'required']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        $town = ['name'=>$request->name, 'region_id'=>$request->region_id];
        if(Town::where($town)->count() > 0){
            return redirect(route('admin.locations.towns'))->with('error', 'Town already exist');
        }
        Town::insert(['name'=>$request->name, 'region_id'=>$request->region_id, 'status'=>1]);
        return redirect(route('admin.locations.towns'))->with('success', 'Town successfully created');
    }

    public function edit_town(Request $request, $slug){
        $data['town'] = Town::find($slug);
        $data['regions'] = Region::all();
        $data['title'] = "Edit Town";
        return view('admin.towns.edit', $data);
    }

    public function update_town(Request $request, $id){
        $validity = Validator::make($request->all(), ['name'=>'required', 'region_id'=>'required']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        $town_record = Town::find($id);
        if($town_record == null){
            return back()->with('error', "Town not found");
        }

        $town = ['name'=>$request->name, 'region_id'=>$request->region_id, 'status'=>$request->status??1];
        if(Town::where($town)->count() > 0){
            return redirect(route('admin.locations.towns'))->with('error', 'Town already exist');
        }
        $town_record->update($town);
        return redirect(route('admin.locations.towns'))->with('success', 'Town successfully updated');
    }

    public function delete_town($id){
        $town = Town::find($id);
        if($town != null){
            $town->delete();
            return redirect(route('admin.locations.towns'))->with('success', 'Town successfully deleted');
        }
        return redirect(route('admin.locations.towns'))->with('error', 'Town not found');
    }

    public function save_street(Request $request){
        // dd($request->all());
        $validity = Validator::make($request->all(), ['name'=>'required', 'town_id'=>'required']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        $street = ['name'=>$request->name, 'town_id'=>$request->town_id];

        if(Street::where($street)->count() > 0){
            return back()->with('error', "Street already exist");
        }

        Street::insert(['name'=>$request->name, 'town_id'=>$request->town_id, 'status'=>1]);
        return redirect(route('admin.locations.streets'))->with('success', "Street succesfully created");
    }

    public function edit_street($id){
        $data['street'] = street::find($id);
        $data['title'] = "Edit Street";
        $data['towns'] = Town::orderBy('name')->get();
        return view('admin.streets.edit', $data);
    }

    public function update_street(Request $request, $id){
        $validity = Validator::make($request->all(), ['name'=>'required', 'town_id'=>'required']);
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        $street = Street::find($id);
        $street_data = ['name'=>$request->name, 'town_id'=>$request->town_id];
        // if street doesn't exist, insert; else update
        if($street == null){
            if(Street::where($street_data)->count() == 0){
                Street::insert(['name'=>$request->name, 'town_id'=>$request->town_id, 'status'=>1]);
            }
            return redirect(route('admin.locations.streets'))->with('success', 'Street successfully updated');
        }
        if(Street::where($street_data)->count() > 0){
            return  redirect(route('admin.locations.streets'))->with('error', "Street already exist");
        }
        $street->update($street_data);
        return redirect(route('admin.locations.streets'))->with('success', 'Street successfully updated');
    }

    public function delete_street($id){
        if(($street = Street::find($id)) != null){
            $street->delete();
            return redirect(route('admin.locations.streets'))->with('success', 'Street successfully deleted');
        }
        return redirect(route('admin.locations.streets'))->with('error', 'Street not found');
    }

    public function save_business_branch(Request $request, $business_slug){
        $validity = Validator::make($request->all(), [
            'name'=>'required', 'category'=>'required', 'region'=>'required', 
            'town'=>'required', 'street'=>'required', 'website'=>'url|nullable',
            'verification_status'=>'required', 'phone'=>'required|integer', 'phone_code'=>'required_with:phone', 
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 'whatsapp_phone'=>'integer|nullable', 'email'=>'email|required',
        ]);

        if($validity->fails()){
            return back()->with('error', $validity->errors()->first())->withInput();
        }

        $business = new Shop();
        $data = [
            'name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description, 'region_id'=>$request->region, 'user_id'=>auth()->id(), 'is_branch'=>true, 'parent_slug'=>$business_slug,
            'town_id'=>$request->town, 'street_id'=>$request->street, 'website'=>$request->website, 'phone'=>$request->phone_code.$request->phone, 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
            'whatsapp_phone'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'email'=>$request->email, 'status'=>$request->verification_status, 
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
        $business->save();
        return redirect(route('admin.businesses.branch.index', ))->with('success', 'Branch successfully created');
    }

    public function save_business(Request $request){
        
        $validity = Validator::make($request->all(), [
            'name'=>'required', 'category'=>'required', 'region'=>'required', 
            'town'=>'required', 'street'=>'required', 'website'=>'url|nullable',
            'verification_status'=>'required', 'phone'=>'required|integer', 'phone_code'=>'required_with:phone', 
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 'whatsapp_phone'=>'integer|nullable', 'email'=>'email|required',
        ]);

        if($validity->fails()){
            return back()->with('error', $validity->errors()->first())->withInput();
        }

        $business = new \App\Models\Shop();


        $shop_data = ['name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description,  'user_id'=>auth('admin')->id(),  'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
                    'status'=>$request->verification_status, ];
        if(Shop::where(['name'=>$request->name])->count() > 0){
            return redirect(route('admin.businesses.index'))->with('error', 'Business with same name already exist');
        }
        // SAVE BUSINESS DATA
        $business->fill($shop_data);
        if(($file = $request->file('logo')) != null){
            $path = public_path('uploads/logos/');
            $fname = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $business->image_path = $path.$fname;
        }
        $business->save();

        // SAVE BUSINESS CONTACT INFO
        $contact_data = ['shop_id'=>$business->id, 'street_id'=>$request->street, 'phone'=>$request->phone_code.$request->phone, 'whatsapp'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'website'=>$request->website, 'email'=>$request->email];
        \App\Models\ShopContactInfo::updateOrInsert(['shop_id'=>$business->id], $contact_data);
        return redirect(route('admin.businesses.index'))->with('success', 'Business successfully created');
    }

    public function edit_business($slug){
        $data['business'] = Shop::whereSlug($slug)->first();
        if($data['business'] != null){
            $data['title'] = "Edit Business";
            $data['categories'] = Category::orderBy('name')->get();
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
                'name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description, 'region_id'=>$request->region, 'user_id'=>auth()->id(), 
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


    public function all_pages()
    {
        # code...
    }


    public function show_privacy_policy()
    {
        # code...
        $data['title'] = "Privacy Policies";
        return view('admin.pages.privacy_policy', $data);
    }


    public function save_privacy_policy(Request $request)
    {
        # code...
        $validity = Validator::make($request->all(), ['title'=>'required', 'content'=>'required']);
        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

//        $data = ['title'=>$request->title, 'content'=>$request->content];
//        if(PrivacyPolicy::where(['title'=>$request->title])->count() > 0){
//            session()->flash('error', "A privacy policy record with the same tiitle already exist");
//            return back()->withInput();
//        }
//
//        (new PrivacyPolicy($data))->save();
        return back()->with('success', "Operation complete");
    }
}
