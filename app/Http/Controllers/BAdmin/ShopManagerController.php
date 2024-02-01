<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopManagerController extends Controller
{

    protected 
        $shopService;
    public function __construct(
        ShopService $shopService
    )
    {
        # code...
        $this->shopService = $shopService;
    }

    //
    public function managers($shop_slug){
        $shop = $this->shopService->getBySlug($shop_slug);
        $data['title'] = "Managers of ".$shop->name;
        $data['shop'] = $shop;
        $data['managers'] = $this->shopService->getManagers($shop->id);
        return view('b_admin.businesses.managers.index', $data);
    }


    
    public function create_manager($shop_slug)
    {
        # code...
        $data['shop'] = $this->shopService->getBySlug($shop_slug);
        $data['title'] = "Add Manager To ".$data['shop']->name??'';
        return view('b_admin.businesses.managers.create', $data);
    }

    public function send_manager_request ($shop_slug, $user_id)
    {
        # code...
        try {
            //code...
            $shop_id = $this->shopService->getBySlug($shop_slug)->id;
            $data = ['shop_id'=>$shop_id, 'user_id'=>$user_id, 'status'=>0];
            $this->shopService->saveManager($data);
            return redirect()->route('business_admin.managers.index', $shop_slug);
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
    }


}
