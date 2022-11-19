<?php
/**
 * User: Dieudonne Takougang
 * @Description: handle general utility for application
 */

namespace Modules\Utility\Services;

use App\Mail\RunProductSearchErrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\GeneralModule\Config\AccountType;
use Modules\Product\Entities\Product;
use Modules\Location\Services\Interfaces\LocationService;
use Modules\Shop\Services\ShopService;
use Modules\Utility\Services\Interfaces\UtilityServiceInterface;
use Modules\Utility\Services\SMSAPI\SMSGateway;

class UtilityService implements UtilityServiceInterface
{
    private $request;
    private $locationService;
    private $smsProvider;

    public function __construct(Request $request, LocationService $locationService, SMSGateway $SMSGateway)
    {
        $this->request = $request;
        $this->locationService = $locationService;
        $this->smsProvider = $SMSGateway;
    }

    public function addSessionData($key, $data)
    {
        $this->request->session()->put($key, $data);
    }

    public function getSessionDataByKey($key)
    {
        return $this->request->session()->get($key);
    }

    public function hasSessionValue($key)
    {
        return $this->request->session()->has($key);
    }

    public function forgetSessionByKey($key)
    {
        session()->forget($key);
    }

    public function clearSession()
    {
        Auth::logout();
        $this->request->session()->flush();
    }

    public function getCurrentLoggedUser()
    {
        return Auth::user();
    }

    public static function getUserId()
    {
        return Auth::user()->id;
    }

    public function getShopAddressByShopContactId($shopContactId)
    {
        $shopLocation = $this->locationService->findStreetById($shopContactId);
        return $shopLocation->name . " , " . $shopLocation->town->name . " ," . $shopLocation->town->region->name . " , " . $shopLocation->town->region->country->name;
    }

    public function getCurrentUserType()
    {
        return Auth::user()->user_type;
    }

    public function getCurrentUserShop()
    {
        //return Shop::find(10);
        return Auth::user()->shop;
    }

    public function generateRandSlug()
    {
        return Str::random(15) . time() . Str::random(5);
    }

    public function checkUserPasswordValid($newPassword, $currentPassword)
    {
        return Hash::check($newPassword, $currentPassword);
    }

    public function getCurrencies()
    {
        return collect(DB::table('currencies')->get());
    }

    public function getCurrency($id)
    {
        return collect(DB::table('currencies')->where('id', $id)->first());
    }

    public function sendSMS($message, $receipients)
    {
        //check if message length is greater than 160 characters
        if (strlen($message) > 160) {
            return "00";
        }
        //if recipient is an array, then we convert to an comma separated string
        if (is_array($receipients)) {
            $receipients = implode(",", $receipients);
        }
        $smsResponse = $this->smsProvider
            ->setMessage($message)
            ->setRecipients($receipients)
            ->prepareSMSMessage()
            ->sendMessage();
        //check for success message;
        if ($smsResponse->status == 200) {
            return "01";
        }
        return "02";
    }

    public function bulkSendEmailsProductCustomQuote($quote, $emails)
    {
        if (count($emails) > 0) {
            foreach ($emails as $email) {
                Mail::to($email)->send(new RunProductSearchErrand($quote));
            }
        }
    }

    public static function getUserHomePage()
    {
        if(!Auth::check()){
            return route('login_page');
        }
        $userType = Auth::user()->user_type;
        if (AccountType::$IS_CUSTOMER == $userType) {
            //send to customer dashboard
            return route('user_profile');
        }
        if (AccountType::$IS_VENDOR == $userType) {
            //send to vendor dashboard
            return route('products');
        }
        return route('shop_list');
    }

    public static function hasUserSubscribedShop($shop_id, $user_id)
    {
        $shopService = App::make(ShopService::class);
        $userShopSubscription = collect($shopService->isUserSubscribedShop($user_id, $shop_id));
        if ($userShopSubscription->isNotEmpty()) {
            return true;
        }
        return false;
    }


    public function indexProduct($id){
        $product = Product::find($id);
       try{
             $product->search_index = $product->name." ".
               $product->description." ".
               $product->summary." ".
               $product->unit_price." ".
               $product->subCategory->name." ".
               $product->subCategory->description." ".
               $product->shop->user->name." ".
               $product->shop->user->description." ".
               $product->shop->name." ".
               $product->shop->shopContactInfo->address." ".
               (isset($product->shop->shopContactInfo)?(
                   $product->shop->shopContactInfo->street->name." ".
                   $product->shop->shopContactInfo->street->town->name." ".
                   $product->shop->shopContactInfo->street->town->region->name." "
               ):"").
               $product->shop->description;
           $product->save();
       }catch (\Exception $e){

       }
    }
}
