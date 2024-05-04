<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Street;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LocationController extends Controller {

    public function streets(Request $request)
    {
        # code...
        $data['title'] = "All Streets";
        $data['streets'] = Street::orderBy('id', 'DESC')->get();
        return view('admin.streets.index', $data);
    }

    public function towns(Request $request)
    {
        # code...
        $data['title'] = "All Towns";
        $data['towns'] = Town::orderBy('id', 'DESC')->get();
        return view('admin.towns.index', $data);
    }

    public function create_town(Request $request)
    {
        # code...
        $data['title'] = "Create Town";
        $data['regions'] = Region::all();
        return view('admin.towns.create', $data);
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

}
