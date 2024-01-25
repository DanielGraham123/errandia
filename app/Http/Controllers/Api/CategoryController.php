<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryTreeResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

class CategoryController extends Controller
{
    //
    protected $CATEGORY_IMAGE_STORAGE_FOLDER  = 'assets/admin/icons';
    // protected $CATEGORY_IMAGE_STORAGE_FOLDER  = "uploads/catregory_images";

    public function getAll() // get all categories
    {
        # code...
        $categories = Category::orderBy('name')->get();
        return response()->json(['status'=>'success', 'data'=>CategoryResource::collection($categories)]);
    }

    public function getTree() // get all categories structured in tree as root->parents->children
    {
        # code...
        $categories = Category::where('category_id', 0)->get()->map(function($record){
            $record->children = Category::where('category_id', $record->id)->get();
            return $record;
        });
        
        return response(['data'=>['categories'=>CategoryTreeResource::collection($categories)]]);
    }

    public function getBySlug($slug) // get category by slug
    {
        # code...
        $category = Category::whereSlug($slug)->get();
        return response()->json(['status'=>'success', 'data'=>CategoryResource::collection($category)]);
    }

    public function getWithChildren($slug) // get category by slug
    {
        # code...
        $category = Category::whereSlug($slug)->first();
        $category->children = Category::where('category_id', $category->id)->get();
        return response(['data'=> ['category'=>new CategoryTreeResource($category)]]);
    }

    public function save(Request $request) // create a new category
    {
        # code...
        $this->validate($request->all(), ['name'=>'required', 'description'=>'required', 'image'=>'required']);

        if(!empty($this->validations_errors)){
            return $this->build_response(response(), collect($this->validations_errors)->first(), 400);
        }

        try {
            //code...
            $record = DB::transaction(function()use($request){
                $data = [
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'category_id'=>$request->category_id??0,
                    'slug'=>'CAT'.random_bytes(10).time().random_int(1000, 9999)
                ];
                if(($file = $request->file('image')) != null){
                    $fname = 'category_'.time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path($this->CATEGORY_IMAGE_STORAGE_FOLDER), $fname);
                    $data['image_path'] = $fname;
                }
                $category = new Category($data);
                $category->save();
                return $category;
            });
    
            return response()->json(['data'=>['category'=>new CategoryResource($record)]]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->build_response(response(), $th->getMessage(), 500);
        }
    }

    public function update(Request $request, $slug)
    {
        # code...
        try {
            //code...
            // return $request->all();
            $record = DB::transaction(function()use($request, $slug){
                $category = Category::whereSlug($slug)->first();
                if($request->has('name')){$category->name = $request->name;}
                if($request->has('description')){$category->description = $request->description;}
                if($request->has('category_id')){$category->category_id = $request->category_id;}
                if($request->has('image') && ($file = $request->file('image')) != null){
                    $fname = 'category_update_'.time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path($this->CATEGORY_IMAGE_STORAGE_FOLDER), $fname);
                    $category->image_path = asset($this->CATEGORY_IMAGE_STORAGE_FOLDER.'/'.$fname);
                }
                $category->save();
                return $category;
            });
            return response()->json(['data'=>['category'=>new CategoryResource($record)]]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->build_response(response(), $th->getMessage(), 500);
        }
    }

    public function delete($slug)
    {
        # code...
        try {
            //code...
            $record = DB::transaction(function()use($slug){
                $category = Category::whereSlug($slug)->first();
                if($category != null){
                    $category->delete();
                }
                return $slug;
            });
            return response()->json(['data'=>['slug'=>$record]]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->build_response(response(), $th->getMessage(), 500);
        }
    }
}
