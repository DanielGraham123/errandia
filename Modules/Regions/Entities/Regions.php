<?php

namespace Modules\Regions\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Location\Entities\Town;

class Regions extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    protected static function newFactory()
    {
        return \Modules\Regions\Database\factories\RegionsFactory::new();
    }

    public function towns()
    {
        return $this->hasMany(Town::class, 'region_id');
    }

    public static function getTableName()
    {
        return "regions";
    }

    public function getAllRegions()
    {
        return Regions::orderBy('name','asc')->get()->all();
    }

    public function getTowns()
    {
        return Regions::select("*")->from('towns')->orderBy('name','asc')->get();
    }

    public function getCategories()
    {
        return Regions::select("*")->from('product_categories')->get();
    }


    public function getRegions()
    {
        $Regions = Regions::select('regions.*')
            ->join('towns', 'towns.region_id', '=', 'regions.id')
            ->join('streets', 'streets.town_id', '=', 'towns.id')
            ->join('shop_contact_info', 'shop_contact_info.street_id', '=', 'streets.id')
            ->join('shops', 'shops.id', '=', 'shop_contact_info.shop_id')
            ->join('shop_subscriptions', 'shops.id', '=', 'shop_subscriptions.shop_id')
            ->where('shops.status', 1)
            ->where('shop_subscriptions.end_date', '>=', Carbon::now())
            ->distinct()
            ->get();
        return $Regions;
    }

    public function getStores($RegionID, $town, $category)
    {
        $perPage=18;
        if (empty($town) && empty($category)) {
            $Store = Regions::select('shops.*')->join('towns', 'towns.region_id', '=', 'regions.id')
                ->join('streets', 'streets.town_id', '=', 'towns.id')
                ->join('shop_contact_info', 'shop_contact_info.street_id', '=', 'streets.id')
                ->join('shops', 'shops.id', '=', 'shop_contact_info.shop_id')
                ->join('shop_subscriptions', 'shops.id', '=', 'shop_subscriptions.shop_id')
                ->where('shop_subscriptions.end_date', '>=', Carbon::now())
                ->where('towns.region_id', '=', $RegionID)
                ->where('shops.status', 1)
                 ->orderBy('shops.name','asc')
                ->paginate($perPage);
        } elseif ($town == '' && $category == '') {
            $Store = Regions::select('shops.*')->join('towns', 'towns.region_id', '=', 'regions.id')
                ->join('streets', 'streets.town_id', '=', 'towns.id')
                ->join('shop_contact_info', 'shop_contact_info.street_id', '=', 'streets.id')
                ->join('shops', 'shops.id', '=', 'shop_contact_info.shop_id')
                ->join('shop_subscriptions', 'shops.id', '=', 'shop_subscriptions.shop_id')
                ->where('shop_subscriptions.end_date', '>=', Carbon::now())
                ->where('shops.status', 1)
                ->where('towns.region_id', '=', $RegionID)
                 ->orderBy('shops.name','asc')
                ->paginate($perPage);
        } else
            if ($town != '' && $category != '') {
                $Store = Regions::select('shops.*')->join('towns', 'towns.region_id', '=', 'regions.id')
                    ->join('streets', 'streets.town_id', '=', 'towns.id')
                    ->join('shop_contact_info', 'shop_contact_info.street_id', '=', 'streets.id')
                    ->join('shops', 'shops.id', '=', 'shop_contact_info.shop_id')
                    ->join('shop_subscriptions', 'shops.id', '=', 'shop_subscriptions.shop_id')
                    ->where('shop_subscriptions.end_date', '>=', Carbon::now())
                    ->where('street_id', '=', $town)
                    ->where('shops.category_id', '=', $category)
                    ->where('shops.status', 1)
                    ->where('towns.region_id', '=', $RegionID)
                     ->orderBy('shops.name','asc')
                    ->paginate($perPage);
            } else
                if ($town != '' && $category == '') {
                    $Store = Regions::select('shops.*')->join('towns', 'towns.region_id', '=', 'regions.id')
                        ->join('streets', 'streets.town_id', '=', 'towns.id')
                        ->join('shop_contact_info', 'shop_contact_info.street_id', '=', 'streets.id')
                        ->join('shops', 'shops.id', '=', 'shop_contact_info.shop_id')
                        ->join('shop_subscriptions', 'shops.id', '=', 'shop_subscriptions.shop_id')
                        ->where('shop_subscriptions.end_date', '>=', Carbon::now())
                        ->where('street_id', '=', $town)
                        ->where('shops.status', 1)
                        ->where('towns.region_id', '=', $RegionID)
                         ->orderBy('shops.name','asc')
                        ->paginate(1);
                } else
                    if ($category != '' && $town == '') {
                        $Store = Regions::select('shops.*')->join('towns', 'towns.region_id', '=', 'regions.id')
                            ->join('streets', 'streets.town_id', '=', 'towns.id')
                            ->join('shop_contact_info', 'shop_contact_info.street_id', '=', 'streets.id')
                            ->join('shops', 'shops.id', '=', 'shop_contact_info.shop_id')
                            ->join('shop_subscriptions', 'shops.id', '=', 'shop_subscriptions.shop_id')
                            ->where('shop_subscriptions.end_date', '>=', Carbon::now())
                            ->where('shops.category_id', '=', $category)
                            ->where('shops.status', 1)
                            ->where('towns.region_id', '=', $RegionID)
                             ->orderBy('shops.name','asc')
                            ->paginate($perPage);
                    }
        return $Store;
    }
}
