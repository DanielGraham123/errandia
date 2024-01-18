<?php
namespace App\Repositories;

use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     * @param string $category_slug: nullable, category slug to query products per category
     */
    public function get($size = null, $item_id = null)
    {
        # code...
        
        $builder = $item_id == null ?
            Review::orderBy('id', 'DESC'):
            Review::where('item_id', $item_id)->orderBy('id', 'DESC');

        $reviews = $size == null ?
            $builder->get() :
            $builder->take($size)->get();

        return ReviewResource::collection($reviews);
    }


    /**
     * get a product or service by slug
     */
    public function getBySlug($id)
    {
        # read the record associated to a given slug
        $review = Review::find($id);
        if($review == null)
            throw new \Exception("Review does not exist");

        return new ReviewResource($review);
    }


    /**
     * save a record to database
     */
    public function store($data)
    {
        # code...
        try {
            $record = DB::transaction(function()use($data){
                $review = new Review($data);
                $review->save();
                return $review;
            });
            return new ReviewResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function update($id, $data)
    {
        # code...
        // validate data and save to database
        try {
            $record = DB::transaction(function()use($id, $data){
                $review = Review::find($id);
                if($review == null)
                    throw new \Exception("Review to ve updated does not exist");

                $review->update($data);
            });
            return new ReviewResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function delete($id)
    {
        # code...
        // validate data and save to database
        $review = Review::find($id);
        if($review == null)
            throw new \Exception("Review to be deleted does not exist");

        $review->delete();
        return true;
    }
}