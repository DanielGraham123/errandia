<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Location\Entities\Street;
use Modules\Location\Services\Interfaces\LocationService;
use Modules\ProductCategory\Entities\SubCategory;
use Modules\ProductCategory\Services\CategoryService;
use Modules\Shop\Http\Requests\CreateShopRequest;
use Modules\Shop\Http\Requests\UpdateShopRequest;
use Modules\Shop\Services\ShopService;
use Modules\User\Services\UserService;
use Modules\Utility\Services\UtilityService;

class ShopController extends Controller
{
    private $shopService;
    private $utilityService;
    private $SubCategory;


    public function __construct(ShopService $shopService, UtilityService $utilityService,SubCategory $SubCategory)
    {
        $this->shopService = $shopService;
        $this->utilityService = $utilityService;
        $this->SubCategory = $SubCategory;
    }

    //get a list of shops registered
    public function index()
    {
        return view('shop::index')->with(['shops' => $this->shopService->getActiveShops()]);
    }

    //show create shop form
    public function create(CategoryService $categoryService, LocationService $locationService)
    {
        return view('shop::create')->with(
            ['categories' => $categoryService->getActiveCategories(),
                'subcategories'=>$this->SubCategory->getAllSubCategories(),
                'regions' => $locationService->getAllRegions(),
            ]);
    }

    //save shop details
    public function store(CreateShopRequest $request, UserService $userService)
    {
        //get shop details
        $shopDetails = $request->getShopData();
        $shopContactInfo = $request->getShopContactData();
        $shopOwnerAccount = $request->getShopUserData();
        $shopCategories = $request->getShopCategories();
        $shopContactInfo['facebook_link'] = is_null($shopContactInfo['facebook_link']) ? "" : $shopContactInfo['facebook_link'];

        $shopDetails['category_id'] = $shopDetails['category_id'] !='none' ? $shopDetails['category_id']: '';
        unset($shopDetails['category_id']);
        //check if entered email address exist
        if ($userService->emailExist($shopOwnerAccount['email'])) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors([trans('shop.add_shop_email_exist_msg', ['email' => $shopOwnerAccount['email']])]);
        }
        $shopOwnerAccount['status'] = 1;
        $shopDetails['slug'] = $this->utilityService->generateRandSlug();
        //start a db transaction
        DB::transaction(function () use ($userService, $shopOwnerAccount, $shopDetails, $shopContactInfo,$shopCategories) {
            //save supplier/shop own account info
            $userId = $userService->saveUserAccount($shopOwnerAccount);
            //save shop details
            $shopDetails['user_id'] = $userId->id;
            $shop = $this->shopService->saveShop($shopDetails);
            //save shop contact info
            $this->shopService->saveShopContactInfo($shop->id, $shopContactInfo);
            //save shop categories
            $this->shopService->saveShopCategories($shop->id, $shopCategories);
        });
        $message = trans('shop.add_shop_success_msg');
        session()->flash('success', $message);
        return redirect()->route('shop_list');
    }

    //get shop details and display
    public function show($slug, LocationService $locationService)
    {

        $shopExist = $this->shopService->findShopBySlug($slug);
        if (empty($shopExist)) {
            return redirect()->route('shop_list')
                ->withErrors([trans('shop.shop_not_found')]);
        }

        $shopLocation = $locationService->findStreetById($shopExist->shopContactInfo->street_id);
        $address = $shopLocation->name . ", ".$shopLocation->town->name .", " . $shopLocation->town->region->name . ", " . $shopLocation->town->region->country->name;
        return view('shop::show')->with(['shop' => $shopExist, 'address' => $address]);
    }

    //show edit shop details form
    public function edit($slug, CategoryService $categoryService, LocationService $locationService)
    {
        $shopExist = $this->shopService->findShopBySlug($slug);
        if (empty($shopExist)) {
            return redirect()->route('shop_list')
                ->withErrors([trans('shop.shop_not_found')]);
        }
        return view('shop::edit')->with(['categories' => $categoryService->getActiveCategories(),
            'shop' => $shopExist, 'regions' => $locationService->getAllRegions(),
             'subcategories'=>$this->SubCategory->getAllSubCategories(),
        ]);
    }
    //update shop details
    public function update(UpdateShopRequest $request, $slug, UserService $userService)
    {
        $shopExist = $this->shopService->findShopBySlug($slug);
        if (empty($shopExist)) {
            return redirect()->route('shop_list')
                ->withErrors([trans('shop.shop_not_found')]);
        }
        //get shop details
        $shopDetails = $request->getShopData();
        $shopContactInfo = $request->getShopContactData();
        $shopCategories = $request->getShopCategories();
        $shopOwnerAccount = $request->getShopUserData();
        $shopContactInfo['facebook_link'] = is_null($shopContactInfo['facebook_link']) ? "" : $shopContactInfo['facebook_link'];
        $shopDetails['category_id'] = $shopDetails['category_id'] !='none' ? $shopDetails['category_id']: '';

        unset($shopDetails['category_id']);
        //start a db transaction
        DB::transaction(function () use ($userService, $shopOwnerAccount, $shopDetails, $shopContactInfo, $shopExist,$shopCategories) {
            //save supplier/shop own account info
            $userService->updateUserAccount($shopOwnerAccount, $shopExist->user->id);
            //save shop details
            $this->shopService->updateShopInfo($shopExist->id, $shopDetails);
            //save shop contact info
            $this->shopService->updateShopContactInfo($shopExist->shopContactInfo->id, $shopContactInfo);
            //delete existing shop categories
            foreach ($shopExist->categories as $category) {
                $category->delete();
            }
            //save shop categories
            $this->shopService->saveShopCategories($shopExist->id, $shopCategories);
        });
        $message = trans('shop.update_shop_success_msg');
        session()->flash('success', $message);
        return redirect()->route('shop_list');
    }

    //delete shop
    public function destroy($slug)
    {
        $shopExist = $this->shopService->findShopBySlug($slug);
        if (empty($shopExist)) {
            return redirect()->route('shop_list')
                ->withErrors([trans('shop.shop_not_found')]);
        }

        //check if shop has products
        $shopHasProducts = $this->shopService->getProductsByShop($shopExist->id);
        if (!$shopHasProducts->isEmpty()) return redirect()
            ->route('shop_list')->withErrors([trans('shop.shop_delete_has_products')]);

        //check if there are product orders for the shop.

        //check if there are any subscriber for this shop
        if (!$this->shopService->getShopSubscribers($shopExist->id)->isEmpty()) return redirect()
            ->route('shop_list')->withErrors([trans('shop.shop_delete_has_subscribers')]);

        //delete shop contact info, user account and shop details
        $this->shopService->deleteShop($shopExist->id);
        //redirect to shop list
        return redirect()->route('shop_list')
            ->with(['success' => trans('shop.shop_delete_success_msg')]);
    }


}
