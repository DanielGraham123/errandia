<?php
namespace Modules\ProductSearch\Http\Controllers;

use App\Jobs\SendProductQuoteByEmail;
use App\Jobs\SendProductQuoteBySMS;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Product\Services\ProductService;
use Modules\ProductCategory\Services\CategoryService;
use Modules\Utility\Services\UtilityService;
use Modules\ProductSearch\Entities\ProductSearch;
use Modules\ProductCategory\Entities\SubCategory;
use Modules\Regions\Entities\Regions;
use Modules\Street\Entities\Street;
use Modules\Product\Http\Requests\AddQuoteRequest;
use Modules\Product\Services\ProductQuoteService;

use Modules\Utility\Services\ImageUploadService;

class ProductSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(ProductSearch $ProductSearch, CategoryService $categoryService, UtilityService $utilityService, SubCategory $SubCategory, Regions $Regions, Street $Street)
    {
        $this->ProductSearch = $ProductSearch;
        $this->utilityService = $utilityService;
        $this->categoryService = $categoryService;
        $this->SubCategory = $SubCategory;
        $this->Regions = $Regions;
        $this->Street = $Street;
    }

    public function index()
    {

        if (empty($_REQUEST['search']) || $_REQUEST['search'] == ""){
            return redirect()->route('general_home');
        }
        $keyword = $_REQUEST['search'];
        $region =  $_REQUEST['region'] ?? 0;
        $town =  $_REQUEST['town']  ?? 0;
        $street =  $_REQUEST['street'] ?? 0;

//        $sub_category =  $_REQUEST['sub_category'] ?? 0;
//        $category =  $_REQUEST['category'] ?? 0;
        $data['keyword'] = $keyword;
//        $data['request']['category'] = $category;
//        $data['request']['sub_category'] = $sub_category;
        $data['request']['region'] = $region;
        $data['request']['town'] = $town;
        $data['request']['street'] = $street;


         $searchResults = $this->ProductSearch->getSearchProducts([
            'search'=>$keyword,
            'region'=>$region,
            'town'=>$town,
            'street'=>$street,

        ]);
        $data['products'] = $searchResults['products'];
        $data['TotalProducts'] = $searchResults['total'];

        $data['shops'] = $this->ProductSearch->getRelatedShops([
            'search'=>$keyword,
            'region'=>$region ?? "",
            'town'=>$town??"",
            'street'=>$street??"",
            'shop_ids'=>$searchResults['shop_ids']

        ]);
//        $data['TotalProducts'] = $this->ProductSearch->getTotalSearchProduct($keyword);
        $data['currencies'] = $this->utilityService->getCurrencies();

        // FOR SORT CATEGORY SUB CATEGORY
        $data['categories'] = $this->categoryService->getAllCategories();
        $data['SubCategories'] = $this->SubCategory->getAllSubCategories();

        $data['regions'] = $this->Regions->getAllRegions();
        $data['towns'] = $this->Regions->getTowns();
        $data['streets'] = $this->Street->getAllStreets();

        if ($region){
            $data['towns'] = DB::table('towns')->where('region_id',$region)->get();
            $data['streets'] = DB::table('streets')
                ->join('towns', 'streets.town_id', '=', 'towns.id')
                ->where('towns.region_id',$region)
                ->select('streets.*')
                ->get();
        }
        if ($town){
            $data['streets'] = DB::table('streets')->where('town_id',$town)->get();
        }

        return view('productsearch::index')->with($data);
    }

    public function productsort()
    {
        $keyword = $_REQUEST['search'];
        $data['keyword'] = $keyword;
        $data['request'] = $_REQUEST;
        $data['products'] = $this->ProductSearch->getAllSortProduct($keyword, $_REQUEST);
        $data['TotalProducts'] = $this->ProductSearch->getTotalSortProduct($keyword, $_REQUEST);
        $data['currencies'] = $this->utilityService->getCurrencies();
        // FOR SORT CATEGORY SUB CATEGORY
        $data['categories'] = $this->categoryService->getAllCategories();
        $data['SubCategories'] = $this->SubCategory->getAllSubCategories();

        $data['regions'] = $this->Regions->getAllRegions();
        $data['towns'] = $this->Regions->getTowns();
        $data['streets'] = $this->Street->getAllStreets();
        return view('productsearch::index')->with($data);
    }

    /**
     * Post product quote action
     */
    public function sendProductQuote(ProductQuoteService $ProductQuoteService, Request $request, ImageUploadService $imageUploadService, ProductService $productService)
    {
        if (!auth()->check()) return redirect()->route("login_page", ['redirectTo' => route('run_errand_page')])->withErrors([trans('general.errands_custom_view_request_auth_msg')]);
        $user = Auth::user();
        //$_POST['PhoneNumber']
        $categories = $_POST['categories'];
        $quoteData['title'] = $_POST['Title'];
        $quoteData['phone_number'] = $user->tel;
        $quoteData['description'] = $_POST['Description'];
        $quoteData['UserID'] = $user->id;
        $quoteData['categories'] = implode(',',$categories);
//        $quoteData[''] = isset($_POST["dialogCategory"]) && $_POST["dialogCategory"] ? $_POST["dialogCategory"] : 0;

        $quoteData['created_at'] = date("Y-m-d h:i:s");
        $quoteData['updated_at'] = date("Y-m-d h:i:s");

        $data['region'] = $_REQUEST['region'] ?? '';
        $data['town'] = $_REQUEST['town'] ?? '';
        $data['street'] = $_REQUEST['street'] ?? '';
        $data['search'] = $_POST['Title'] ?? '';
        $quoteID = $ProductQuoteService->saveProductQuote($quoteData);

//
        // FOR ENQUIRY IMAGE
        if ($quoteID) {

            if ($request->file('image') && count($request->image) > 0) {
                foreach ($request->image  as $image) {
                    if ($image){
                        $imagePath = $imageUploadService->uploadFile(['image'=>$image], 'image', "productquote");
                        $ProductQuoteService->saveQuoteImages($quoteID->id, ['image_path' => $imagePath, 'quote_id' => $quoteID->id]);
                    }
                }
            }
            $quoteUrl = Str::random(5) . $quoteID->id;
            $updateQuote = array('slug' => $quoteUrl);
            $ProductQuoteService->updateQuote($updateQuote, $quoteID->id);
            //get all active shop owners' contact and send an sms to them about
            $regionFilter = $_POST['region'] ?? 0;
            $townFilter = $_POST['town'] ?? 0;
            $streetFilter = $_POST['street'] ?? 0;
            $searchCriteria = array('categories' => $categories, 'region' => $regionFilter, 'town' => $townFilter, 'street' => $streetFilter);

            $shopContacts = $productService->getShopsBySubCategory($searchCriteria);
//            $shopsTels = $shopContacts['tel'];
            if (sizeof($shopContacts)) {
                //send sms to all contacts
                $shopContactsList = $shopContacts->map(function ($store) {
                    $store->shop_tel = "237" . $store->shop_tel;
                    return $store->shop_tel;
                });
                $data = $shopContactsList->toArray();
                $quoteLink = route('showCustomQuotePage', ['url' => $quoteUrl]);
                $message = trans('general.product_quote_sms_msg', ['link' => $quoteLink]);
                //send sms notification to show owners
                SendProductQuoteBySMS::dispatchSync(array('message' => $message, 'contacts' => $data));
                //send email notifications to show owners as well.
                $shopEmailList =  $shopContacts->map(function ($store) {
                    return $store->shop_email;
                });
                //$shopContacts['email'];
                $emailData = $shopEmailList->toArray();
                $quoteID['image'] = collect($ProductQuoteService->getQuoteImages($quoteID->id))->first();
                $quoteObj = array('link' => $quoteLink, 'quote' => $quoteID);
                SendProductQuoteByEmail::dispatchSync(array('quote' => $quoteObj, 'emails' => $emailData));
            } else {
//                session()->flash('message', trans('general.errands_not_sent_msg'));
                return redirect()->back()->withErrors(['No shop with the product you are looking for']);
            }

        } else {
            return redirect()->back()->withErrors([trans('general.errands_not_sent_msg')]);
        }
//        session()->flash('message', trans('Product Quote successfully sent !'));
        return redirect()->route('productsearch', $data)->with(['success' => trans('Product Quote successfully sent !')]);
    }

    public function showCustomQuotePage($quoteUrl, ProductQuoteService $productQuoteService)
    {
        $quoteExist = $productQuoteService->findQuoteBySlugUrl($quoteUrl);
        if (empty($quoteExist)) {
            return redirect()->route('general_home')->withErrors([trans('general.quote_not_found')]);
        }

        $data['featured_image'] = $quoteExist->images->shift();
        $data['quote'] = $quoteExist;
        return view('productsearch::custom_quote')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function showCustomProductSearchPage()
    {
        if (!auth()->check()) return redirect()->route("login_page", ['redirectTo' => route('run_errand_page')])->withErrors([trans('general.errands_custom_view_request_auth_msg')]);
        return view('productsearch::search_errands');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('productsearch::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('productsearch::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function getCategories(Request $request){
        $filter_params =[
            'description'=>$request->title,
            'region'=>$request->region,
            'town'=>$request->town,
            'street'=>$request->street,
            'title'=>$request->title,

        ];
        $categories = DB::table('product_sub_categories')->distinct()->orderBy('name','asc')->get();
        $search_categories = $this->ProductSearch->getSearchCategories($filter_params);
        $options ="";
        if (sizeof($search_categories)){
            foreach ($categories as $category) {
                $selected = false;
                foreach ($search_categories as $search_category){
                    if ($search_category->id == $category->id){
                        $selected = true;
                    }
                }
                if ($selected){
                    $options .= "<option value='".$category->id."' selected>".$category->name."</option>";

                }else{
                    $options .= "<option value='".$category->id."'>".$category->name."</option>";
                }
            }
        }else{
            foreach ($categories as $category) {
                $options .= "<option value='".$category->id."'>".$category->name."</option>";
            }
        }
        return $options;

    }
}

?>
