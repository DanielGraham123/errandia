<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','amount', 'status','duration'];
    
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionFactory::new();
    }
	
	public static function getTableName()
    {
        return "subscriptions";
    }
	
	public function getAllSubscription()
	{
		return  Subscription::get()->all();		
	}
	
	/*public function getAllSubscription()
	{
		//return  Subscription::get()->all();
		$Subscription = Subscription::join('towns', 'towns.id', '=', 'streets.town_id')              
			  ->get(['streets.name', 'streets.id', 'towns.name as townName']);
        
		return $Subscription;      
	}*/
	
	
	public function findSubscriptionByID($id)
	{
		$Subscription = Subscription::select('*')->where('subscriptions.id','=',$id)->get();
		return $Subscription;
	}
	
	public function updateSubscription($id, $subscriptionDatails)
	{
		return Subscription::whereId($id)->update($subscriptionDatails);
	}
	
	public function saveSubscription($subscriptionDatails)
	{
		return Subscription::create($subscriptionDatails);
	}
	public function deleteSubscription($id)
	{
		return Subscription::whereId($id)->delete($id);
	}
	public function ShopSubscription()
	{
		return  Subscription::get()->all();		
	}
	
	public function savePackageSubscription($subscriptionDatails)
	{
		return Subscription::create($subscriptionDatails);
	}
}
