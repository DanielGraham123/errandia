<?php
namespace App\Repositories;

use App\Http\Resources\ErrandResource;
use App\Models\Category;
use App\Models\Errand;
use App\Models\ErrandImage;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class ErrandRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     * @param string $category_slug: nullable, category slug to query products per category
     */
    public function get($size = null, $filter = null)
    {
        # code...
        $errands = null;
        if($size != null){
            $errands = Errand::orderBy('id', 'DESC')
            ->where(function($query)use($filter){
                $filter ==  null ? null : $query->where($filter);
            })->take($size)->get();
        }else{
            $errands = Errand::orderBy('id', 'DESC')
            ->where(function($query)use($filter){
                $filter ==  null ? null : $query->where($filter);
            })->get();
        }
        return ErrandResource::collection($errands);
    }

    public function search($size = null, $filter = null)
    {
        # code...
        $rawSql = '';
        foreach ($filter as $key => $value) {
            # code...
            if(strlen($rawSql) > 0){
                $rawSql += "or ";
            }
            $rawSql += "{$key} like %{$value}% ";
        }
        $errands = Errand::where(DB::raw($rawSql))->get();
        return ErrandResource::collection($errands);
    }

    public function recievedErrands($size, $user_id)
    {
        # code...
        $user = User::find($user_id);
        $shops = $user->shops;

        // get categories of the current user's shops
        $shop_categories = [];
        foreach ($shops as $key => $shop) {
            # code...
            foreach ($shop->categories as $key => $subcat) {
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
            $_errands = \App\Models\Errand::where('sub_categories', 'LIKE', '%'.$sci.'%')->where('read_status', 0)->where('status', 1)->where('user_id', '!=', auth()->id())
                ->orderBy('id', 'DESC')->take($size > 0 ? $size : 100)->get();
            foreach ($_errands as $key => $err) {
                # code...
                $errands[] = $err;
            }
        }
        return ErrandResource::collection($errands);
    }


    /**
     * get a product or service by slug
     */
    public function getBySlug($slug)
    {
        # read the record associated to a given slug
        $errand = Errand::whereSlug($slug)->first();
        return new ErrandResource($errand);
    }


    /**
     * save a record to database
     * @param array $data associative array of 
     */
    public function store($data)
    {
        # code...
        // validate data and save to database
        try{
            $record = DB::transaction(function()use($data){
                $errand = new Errand($data);
                $errand->save();
                return $errand;
            });
            return new ErrandResource($record);
        }catch(Throwable $th){
            throw $th;
        }
    }



    /**
     * store errand images to database
     * @param array $data; array of images data for the errand; (array of ['item_quote_id'=>'errand_id', 'image'=>'image_url'] pairs) 
     */
    public function saveImages($data)
    {
        # code...
        if(!empty($data) && is_array($data))
            ErrandImage::insert($data);
        return true;
    }



    /**
     * update a record in database
     */
    public function update($slug, $data)
    {
        # code...
        // validate data and save to database
        try {
            $record = DB::transaction(function()use($data, $slug){
                $errand = Errand::whereSlug($slug)->first();
                $errand->update($data);
                return $errand;
            });
            return new ErrandResource($record);
        } catch (Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function delete($slug)
    {
        # code...
        $errand = Errand::whereSlug($slug)->first();
        if($errand == null){
            throw new Exception("Errand to be deleted not found");
        }
        $errand->delete();
        return true;
    }
}