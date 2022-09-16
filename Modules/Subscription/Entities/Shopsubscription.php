<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Shopsubscription extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id','subscription_id','start_date', 'end_date'];
    
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionFactory::new();
    }
	
	public static function getTableName()
    {
        return "shop_subscriptions";
    }
	
	public function getAllSubscription()
	{
		return  Shopsubscription::get()->all();		
	}
	
	/*public function getAllShopubscription()
	{
		//return  Shopubscription::get()->all();
		$Shopubscription = Shopubscription::join('towns', 'towns.id', '=', 'streets.town_id')              
			  ->get(['streets.name', 'streets.id', 'towns.name as townName']);
        
		return $Shopubscription;      
	}*/
	
	
	public function findShopubscriptionByID($id)
	{
		$Shopsubscription = Shopubscription::select('*')->where('subscriptions.id','=',$id)->get();
		return $Shopsubscription;
	}
	
	public function updateShopubscription($id, $subscriptionDatails)
	{
		return Shopsubscription::whereId($id)->update($subscriptionDatails);
	}
	
	public function saveSubscription($subscriptionDatails)
	{
		return Shopsubscription::create($subscriptionDatails);
	}
	public function deleteSubscription($id)
	{
		return Shopsubscription::whereId($id)->delete($id);
	}
	public function ShopSubscription()
	{
		return  Shopsubscription::get()->all();		
	}
	
	public function savePackageSubscription($subscriptionDatails)
	{
		return Shopsubscription::create($subscriptionDatails);
	}
}

?>
