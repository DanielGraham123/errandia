<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrandResource;
use App\Models\Errand;
use Illuminate\Http\Request;

class ErrandController extends Controller
{
    /**
     * @param mixed $slug; optional errand slug to be returned. Otherwise, last 20 errands are returned
     * @return ErrandResource::class|JsonResourceCollection::class
     */
    public function get($slug = null)
    {
        # code...
        if($slug != null){
            $errand = Errand::whereSlug($slug)->first();
            return new ErrandResource($errand);
        }
        $errands  = Errand::paginate(20);
        return ErrandResource::collection($errands);
    }
    //

    /**
     * store a new record of an errand to the database
     * @param Request $request 
     * @return Errand|mixed
     */
    public function save(Request $request)
    {
        # code...
        $rules = [
            'title'=>'required|string', 
            'street_id'=>'nullable|numeric', 
            'town_id'=>'nullable|numeric',
            'region_id'=>'numeric|nullable',
            'description'=>'string|nullable',
            'slug'=>'required|string',
            'user_id'=>'required|numeric'
        ];
        $this->validate($request->all(), $rules);
        if(!empty($this->validations_errors)){
            return response($this->validations_errors, 400);
        }
    }


}
