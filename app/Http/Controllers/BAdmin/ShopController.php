<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\GeographicalService\RegionService;
use App\Services\GeographicalService\StreetService;
use App\Services\GeographicalService\TownService;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    //
    protected 
        $shopService,
        $categoryService,
        $regionService,
        $townService,
        $streetService;
    public function __construct(
        ShopService $shopService, 
        CategoryService $categoryService,
        RegionService $regionService, 
        TownService $townService, 
        StreetService $streetService
        )
    {
        # code...
        $this->shopService = $shopService;
        $this->categoryService = $categoryService;
        $this->regionService = $regionService;
        $this->townService = $townService;
        $this->streetService = $streetService;
    }


    
    public function businesses(){
        $data['businesses'] = $this->shopService->getUserShops(auth()->id());
        return view('b_admin.businesses.index', $data);
    }

    public function create_business(){
        $data['user'] = auth()->user();
        $data['categories'] = $this->categoryService->getAll(null, ['category_id'=>!null]);
        $data['regions'] = $this->regionService->getAllRegions();
        $data['towns'] = $this->townService->get();
        $data['streets'] = $this->streetService->get();
        return view('b_admin.businesses.create', $data);
    }

    public function create_business_branch($slug){
        $data['user'] = auth()->user();
        $data['parent'] = $this->shopService->getBySlug($slug);
        $data['categories'] = $this->categoryService->getAll(null, ['category_id'=>!null]);
        $data['regions'] = $this->regionService->getAllRegions();
        $data['towns'] = $this->townService->get();
        $data['streets'] = $this->streetService->get();
        return view('b_admin.businesses.branches.create', $data);
    }

    public function save_business(Request $request){
        
        $validity = Validator::make($request->all(), [
            'name'=>'required',
            'category'=>'required',
//            'region'=>'required',
//            'town'=>'required',
//            'street'=>'required',
            'website'=>'url|nullable',
            'phone'=>'required|integer',
            'phone_code'=>'required_with:phone',
            'whatsapp_phone_code'=>'required_with:whatsapp_phone', 
            'whatsapp_phone'=>'integer|nullable',
            'email'=>'email|nullable',
        ]);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        try {
    
            $shop_data = [
                'name'=> $request->name,
                'category_id'=>$request->category,
                'description'=>$request->description,
                'user_id'=>auth()->id(),
                'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre',
                'status'=> 1,
                'image'=>$request->file('image')
            ];
            $business = $this->shopService->save($shop_data);
            logger()->info("business successfully created");
    
            // SAVE BUSINESS CONTACT INFO
            $contact_data = [
                'shop_id'=>$business->id,
                'address'=>$request->address??'',
                'street_id'=> $request->street,
                'phone'=>$request->phone_code.$request->phone,
                'whatsapp'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null,
                'website'=>$request->website,
                'email'=>$request->email];
            $this->shopService->updateContactInfo($business->id, $contact_data);
            logger()->info("business contact successfully saved");
            
            // SET DEFAULT BUSINESS MANAGER
            $manager_data = [
                'shop_id'=>$business->id,
                'user_id'=>auth()->id(),
                'is_owner'=>true, 'status'=>true
            ];
            $this->shopService->updateManagers($business->id, $manager_data);
            logger()->info(" Business manager successfully saved");
    
            return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
        } catch (\Throwable $th) {
            //throw $th;
            logger()->error($th->getMessage());
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
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


        try {
            
            $shop_data = ['name'=>$request->name, 'description'=>$request->description, 'category_id'=>$request->category, 'user_id'=>auth()->id(), 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
            'status'=>$request->status, 'is_branch'=>true, 'parent_slug'=>$request->parent_slug??null, 'image'=>$request->file('image')];
            $business = $this->shopService->save($shop_data);
    
            // SAVE BUSINESS CONTACT INFO
            $contact_data = ['shop_id'=>$business->id, 'address'=>$request->address??'', 'street_id'=>$request->street, 'phone'=>$request->phone_code.$request->phone, 'whatsapp'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'website'=>$request->website, 'email'=>$request->email];
            $this->shopService->updateContactInfo($business->id, $contact_data);
            
            // SET DEFAULT BUSINESS MANAGER
            $manager_data = ['shop_id'=>$business->id, 'user_id'=>auth()->id(), 'is_owner'=>true, 'status'=>true];
            $this->shopService->updateManagers($business->id, $manager_data);
    
            return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
    }

    public function edit_business($slug){
        $data['shop'] = $this->shopService->getBySlug($slug);
        if($data['shop'] != null){
            $data['title'] = "Edit Business";
            $data['categories'] = $this->categoryService->getAll(null, ['category_id'=>!null]);
            $data['regions'] = $this->regionService->getAllRegions();
            $data['towns'] = $this->townService->get();
            $data['streets'] = $this->streetService->get();
            return view('b_admin.businesses.edit', $data);
        }
    }

    public function update_business(Request $request, $slug){
        
        $validity = Validator::make($request->all(), [
            'name'=>'required', 'category'=>'required', 'region'=>'required', 
            'town'=>'required', 'street'=>'required', 'website'=>'url',
            'is_branch'=>'required', 'phone'=>'required|integer',
            //  'phone_code'=>'required_with:phone', 
             'whatsapp_phone'=>'integer|nullable', 'email'=>'email',
        ]);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        try {
            //code...
            $shop_data = ['name'=>$request->name, 'category_id'=>$request->category, 'description'=>$request->description,  'user_id'=>auth()->id(),  'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre', 
                    'status'=>false, ];
            $business = $this->shopService->update($slug, $shop_data);
    
            // SET CONTACT INFO
            $contact_data = ['shop_id'=>$business->id, 'address'=>$request->address??'', 'street_id'=>$request->street, 'phone'=>$request->phone_code.$request->phone, 'whatsapp'=>$request->whatsapp_phone != null ? $request->whatsapp_phone_code.$request->whatsapp_phone : null, 'website'=>$request->website, 'email'=>$request->email];
            $this->shopService->updateContactInfo($business->id, $contact_data);
            
            // SET DEFAULT BUSINESS MANAGER
            $manager_data = ['shop_id'=>$business->id, 'user_id'=>auth()->id(), 'is_owner'=>true, 'status'=>true];
            $this->shopService->updateManagers($business->id, $manager_data);
            
            return redirect(route('business_admin.businesses.index'))->with('success', 'Business successfully created');
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }

    }

    public function show_business ($slug){
        try {
            //code...
            $data['shop'] = $this->shopService->getBySlug($slug);
            return view('b_admin.businesses.show', $data);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    

    public function delete_business($slug)
    {
        try {
            //code...
            $this->shopService->delete($slug, auth()->id());
            return back()->with('success', "Operation complete");
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    

    public function suspend_business($slug)
    {
        
    }
    
}
