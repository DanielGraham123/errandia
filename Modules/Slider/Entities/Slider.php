<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['image','caption','category','sub_category','duration','status','duration'];

    protected static function newFactory()
    {
        return \Modules\Slider\Database\factories\SliderFactory::new();
    }

	public static function getTableName()
    {
        return "sliders";
    }

	public function getAllSlider()
	{
		//return  Slider::get()->all();
		$Slider = Slider::join('product_sub_categories', 'product_sub_categories.id', '=', 'sliders.sub_category')
			  ->get(['image','caption','duration','sliders.created_at','product_sub_categories.slug as slug','product_sub_categories.name as name','sliders.id as id','sliders.status'])->all();

		return $Slider;
	}

	/*public function getAllSubscription()
	{
		//return  Subscription::get()->all();
		$Subscription = Subscription::join('towns', 'towns.id', '=', 'streets.town_id')
			  ->get(['streets.name', 'streets.id', 'towns.name as townName']);

		return $Subscription;
	}*/


	public function findSliderByID($id)
	{
		$Slider = Slider::select('*')->where('sliders.id','=',$id)->get();
		return $Slider;
	}

	public function updateSlider($id, $sliderDatails)
	{
		return Slider::whereId($id)->update($sliderDatails);
	}

	public function saveSlider($sliderDatails)
	{
		//print_r($sliderDatails);die;
		return Slider::create($sliderDatails);
	}
	public function deleteSlider($id)
	{
		return Slider::whereId($id)->delete($id);
	}

}

?>
