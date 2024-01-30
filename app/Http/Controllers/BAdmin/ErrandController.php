<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrandResource;
use App\Models\Errand;
use App\Services\CategoryService;
use App\Services\ErrandService;
use App\Services\GeographicalService\RegionService;
use App\Services\GeographicalService\StreetService;
use App\Services\GeographicalService\TownService;
use Illuminate\Http\Request;

class ErrandController extends Controller
{

    protected 
        $errandService,
        $streetService,
        $townService,
        $regionService,
        $categoryService;
    public function __construct(ErrandService $errandService, StreetService $streetService, TownService $townService, RegionService $regionService, CategoryService $categoryService)
    {
        # code...
        $this->errandService = $errandService;
        $this->streetService = $streetService;
        $this->townService = $townService;
        $this->regionService = $regionService;
        $this->categoryService = $categoryService;
    }


    
    public function errands(Request $request){
        $data['action'] = $request->action??null;
        if($request->action == 'posted'){
            $data['errands'] = $this->errandService->get(100, ['user_id'=>auth()->id()]);
            $data['title'] = "Posted Errands";
        }else{


            
            $data['errands'] = $this->errandService->getRecieved(100, auth()->id());
            $data['title'] = "Recieved Errands";
            // dd($shop_category_ids);
            // dd($errands);
        }
        return view('b_admin.errands.index', $data);
    }

    public function create_errand(){
        $data['regions'] = $this->regionService->getAllRegions();
        $data['towns'] = $this->townService->get();
        $data['streets'] = $this->streetService->get();
        return view('b_admin.errands.create', $data);
    }

    public function save_errand(Request $request){
        // save and forward errand for image update
        try {
            $data['errand'] = $request->all();
            $data['title'] = "Post Errand";
            $item = ['title'=>$request->title, 'region_id'=>$request->region??null, 'town_id'=>$request->town??null, 'street_id'=>$request->street??null, 'description'=>$request->description, 'user_id'=>auth()->id(), 'slug'=>'bDC'.time().'swI'.random_int(100000, 999999).'fgUfre'];
    
            $instance = $this->errandService->save($item);
    
            $data['quote'] = $instance;
            // Propose categories
            
            $data['proposed_categories'] = $this->errandService->proposeCategories($instance->slug);
            // dd($categs);
            $data['categories'] = $this->categoryService->getAll(null, ['category_id'=>!null]);
            return view('b_admin.errands.create_categ_images', $data);
            
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
    }

    public function update_save_errand(Request $request){
        // save and forward errand for image update
        try {
            //code...
            $request->validate(['categories'=>'required|array', 'visibility'=>'required', 'quote_slug'=>'required']);
            
            $data = ['sub_categories'=>implode(',', $request->categories), 'visibility'=>$request->visibility, 'status'=>1];
            $quote = $this->errandService->update($request->quote_slug, $data);
    
            if(($gallery = $request->file('images')) != null){
                $this->errandService->saveImages($gallery, $quote->id);
            }
            return redirect()->route('business_admin.errands.index');
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
    }

    public function show_errand ($slug){
        $data['errand'] = $this->errandService->getOne($slug);
        return view('b_admin.errands.show', $data);
    }

    public function edit_errand($slug){
        $data['errand'] = $this->errandService->getOne($slug);
        $data['regions'] = $this->regionService->getAllRegions();
        $data['towns'] = $this->townService->get();
        $data['categories'] = $this->categoryService->getAll(null, ['category_id'=>!null]);
        $data['streets'] = $this->streetService->get();
        return view('b_admin.errands.edit', $data);
    }

    public function update_errand($slug){
        $data['errand'] = $this->errandService->getOne($slug);
        $data['regions'] = $this->regionService->getAllRegions();
        $data['towns'] = $this->townService->get();
        $data['categories'] = $this->categoryService->getAll(null, ['category_id'=>!null]);
        $data['streets'] = $this->streetService->get();
        return view('b_admin.errands.edit', $data);
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


}
