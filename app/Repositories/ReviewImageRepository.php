<?php
namespace App\Repositories;

use App\Http\Resources\ReviewImageResource;
use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Support\Facades\DB;
use Throwable;

class ReviewImageRepository {

    /**
     * get all products
     * @param int $review_id: id of the review item to get images for
     */
    public function get($review_id)
    {
        # code...
        $images = ReviewImage::where('review_id', $review_id)->get();
        return ReviewImageResource::collection($images);

    }


    /**
     * get a product or service by slug
     */
    public function getBySlug($id)
    {
        $image = ReviewImage::find($id);
        if($image == null)
            throw new \Exception("Image does not exist");

        return new ReviewImageResource($image);
    }


    /**
     * save a record to database
     */
    public function store($data)
    {
        # code...
        try {
            //code...
            $record = DB::transaction(function()use($data){
                $image = new ReviewImage($data);
                $image->save();
                return $image;
            });
            return new ReviewImageResource($record);
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
        
    }


    /**
     * update a record in database
     */
    public function delete($id)
    {
        # code...
        $image = ReviewImage::find($id);
        if($image == null){
            throw new \Exception("Image to be deleted does not exist");
        }
        $image->delete();
        return true;
    }
}