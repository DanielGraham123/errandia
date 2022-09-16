<?php

namespace Modules\User\Http\Controllers;

use App\Mail\accountCreated;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\GeneralModule\Config\AccountType;
use Modules\ProductCategory\Services\CategoryService;
use Modules\Shop\Services\ShopService;
use Modules\User\Http\Requests\AddAdminRequest;
use Modules\User\Http\Requests\UpdateBusinessInfoRequest;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Modules\Utility\Services\Interfaces\UtilityServiceInterface;
use Modules\Location\Services\Interfaces\LocationService;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    private $userService;
    private $utilityService;

    public function __construct(UserServiceInterface $userService, UtilityServiceInterface $utilityService)
    {
        $this->userService = $userService;
        $this->utilityService = $utilityService;
    }

    /*
     * Show user account profile page to allow update of details
     */
    public function showUserProfile(ShopService $shopService, LocationService $locationService, CategoryService $categoryService)
    {
        //check if user is vendor or admin or user
        $user_type = $this->utilityService->getCurrentUserType();
        if ($user_type == AccountType::$IS_VENDOR) {
            $user_shop = $this->utilityService->getCurrentUserShop();
            $data['shop'] = $shopService->findShopById($user_shop->id);
            $data['towns'] = $locationService->getAllTowns();
            $data['streets'] = $locationService->getAllStreets();
            $data['address'] = $this->utilityService->getShopAddressByShopContactId($data['shop']->shopContactInfo->street_id);
            return view("user::vendor_profile")->with($data);
        }
        if ($user_type == AccountType::$IS_CUSTOMER) {
            $hasUserProfile = $this->userService->getUserProfileInfo(get_user_id());
            $data['categories'] = $categoryService->getActiveCategories();
            $data['towns'] = $locationService->getAllTowns();
            $data['streets'] = $locationService->getAllStreets();
            $data['profile'] = $hasUserProfile;
            $data['selectedCategories']= empty($hasUserProfile) ? [] : explode('#',$hasUserProfile->categories_interest);
            $data['user'] = $this->utilityService->getCurrentLoggedUser();
            return view("user::customer_profile")->with($data);
        }
        if ($user_type == AccountType::$IS_ADMIN) {
            $data['user'] = $this->utilityService->getCurrentLoggedUser();
            return view("user::admin_profile")->with($data);
        }
    }

    /*
   * change user password
   */
    public function changePassword(Request $request)
    {
        $rules = ['old_password' => 'required', 'password' => 'required|min:6|confirmed', 'password_confirmation' => 'required'];
        $request->validate($rules);
        //check if user password match
        $currentPassword = $request->get('old_password');
        $newPassword = $request->get('password');
        $user = $this->utilityService->getCurrentLoggedUser();
        if (!$this->utilityService->checkUserPasswordValid($currentPassword, $user->password)) {
            return redirect()->back()->withErrors([trans('shop.add_shop_change_invalid_password')]);
        }
        //change user password
        $hasNewPassword = Hash::make($newPassword);
        $useDto = ['password' => $hasNewPassword];
        if ($this->userService->updateUserAccount($useDto, $user->id)) return redirect()->back()->with('success', trans('shop.add_shop_change_success_password'));
    }

    /*
     * update user personal account info
     */
    public function changePersonalInfo(Request $request)
    {
        $rules = ['name' => 'required', 'phone_number' => 'required'];
        $request->validate($rules);
        $userDto = ['name' => trim($request->get('name')), 'tel' => trim($request->get('phone_number'))];
        $user_id = $this->utilityService->getCurrentLoggedUser()->id;
        if ($this->userService->updateUserAccount($userDto, $user_id)) return redirect()->back()->with('success', trans('shop.add_shop_change_success_personal_info'));
    }

    /*
     * Update vendor business info and contact details
     */
    public function updateBusinessInfo(UpdateBusinessInfoRequest $request, ShopService $shopService)
    {
        //get shop info
        $shopExist = $shopService->findShopById($this->utilityService->getCurrentUserShop()->id);
        $shopDetails = $request->getBusinessInfo();
        //get shop contact info
        $shopContactInfo = $request->getBusinessContactInfo();

        //update shop details
        DB::transaction(function () use ($shopService, $shopExist, $shopContactInfo, $shopDetails) {
            //update shop details
            $shopService->updateShopInfo($shopExist->id, $shopDetails);
            //update shop contact info
            $shopService->updateShopContactInfo($shopExist->shopContactInfo->id, $shopContactInfo);
        });
        $message = trans('shop.update_shop_success_msg');
        session()->flash('success', $message);
        return redirect()->back();
    }

    public function showUsers()
    {
        if (isset($_REQUEST['keyword']))
            $keyword = $_REQUEST['keyword'];
        else
            $keyword = '';
        $data['keyword'] = $keyword;
        $data['users'] = $this->userService->getAllUsers($keyword);
        return view('user::index')->with($data);
    }

    public function suspendAccount($ID)
    {
        $updateUser = $this->userService->suspendUser($ID);
        if ($updateUser) {
            return redirect()->route('users')
                ->with(['success' => trans('admin.user_suspend_msg')]);
        }
    }

    public function activeAccount($ID)
    {
        $updateUser = $this->userService->activeUser($ID);
        if ($updateUser) {
            return redirect()->route('users')
                ->with(['success' => trans('admin.user_suspend_msg')]);
        }
    }

    public function showAddAdminPage()
    {
        return view('user::create_admin');
    }

    public function addAdminAccount(AddAdminRequest $request)
    {
        $create_account_dto = $request->getUserDTO();
        if ($this->userService->emailExist($create_account_dto['email'])) {
            return redirect()->back()->withInput($request->all())->withErrors([trans('general.register_email_exist_msg')]);
        }
        $create_account_dto['user_type'] = 10;
        $user_account = $this->userService->saveUserAccount($create_account_dto);
        if ($user_account) {
            //send welcome mail to user
            Mail::to($user_account)->send(new accountCreated($user_account));
            //flash success message and redirect back
            $request->session()->flash('success', trans('admin.admin_account_success'));
            return redirect()->route("admin_list")->with('success', trans('admin.admin_account_success'));
        } else {
            return redirect()->back()->withErrors([trans('general.register_account_error')])->withInput($request->all());
        }
    }

    public function showManageAdminPage()
    {
        $adminUsers = $this->userService->getAllAdminUsers();
        $data['users'] = $adminUsers;
        return view("user::admin_list")->with($data);
    }
}
