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

    public function subscription_report (Request $reuest)
    {
        # code...
        $data['title'] = "All Subscriptions";
        $data['subscriptions'] = ShopSubscription::all();
        return view('admin.reports.subscriptions', $data);
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
