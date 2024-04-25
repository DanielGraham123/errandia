<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Region;
use App\Models\Shop;
use App\Models\Street;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index()
    {
        $data['title'] = "All Businesses";
        $data['businesses'] = Shop::orderBy('id', 'DESC')->get();
        return view('admin.businesses.index', $data);
    }

    public function create_business(Request $request)
    {
        # code...
        $data['title'] = "Create New Business";
        $data['categories'] = Category::orderBy('name')->get();
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        return view('admin.businesses.create', $data);
    }

    public function save_business(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {

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

    public function show_business(Request $request, $business = null): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        # code...
        $data['title'] = "Business Details";
        return view('admin.businesses.show', $data);
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

    public function business_branches(Request $request, $business_slug)
    {
        # code...
        $data['item'] = Shop::whereSlug($business_slug)->first();
        $data['title'] = "Businesses Branches For ".$data['item']->name;
        $data['businesses'] = $data['item']->branches()->orderBy('id', 'DESC')->get();
        return view('admin.businesses.branches.index', $data);
    }

    public function update_business(Request $request, $slug){

        $validity = Validator::make($request->all(), [
            'name'=>'required', 'category'=>'required', 'region'=>'required',
            'street'=>'required', 'website'=>'url',
           'phone'=>'integer',
            //  'phone_code'=>'required_with:phone',
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 'whatsapp_phone'=>'integer|nullable', 'email'=>'email|required',
        ]);

        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }

        $business = Shop::where('slug',$slug)->first();

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

    public function delete_business(Request $request, $slug){
        $business = Shop::whereSlug($slug)->first();
        if($business != null){
            $business->delete();
            return redirect(route('admin.businesses.index'))->with('success', 'Business successfully deleted');
        }
        return redirect(route('admin.businesses.index'))->with('error', 'Business not found');
    }
}