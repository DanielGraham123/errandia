<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Errand;
use App\Models\Product;
use App\Models\Region;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Town;
use App\Services\GeographicalService\RegionService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use \App\Models\Shop;


class WelcomeController extends Controller
{
    private $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }



    public function searchUser(Request $request)
    {
        // return $request->par;
        $users = \App\Models\User::where('name', 'LIKE', '%'.$request->par.'%')->orWhere('email', 'LIKE', '%'.$request->par.'%')->get(['*']);
        return response()->json(['users'=>$users]);
    }
    public function home()
    {
        $data['errands'] = Errand::orderBy('created_at', 'ASC')->take(6)->get();
        $data['services'] = Product::join('item_enquiries', ['items.id' => 'item_enquiries.item_id'])
                            ->where('items.service', true)
                            ->orderBy('item_enquiries.created_at', 'ASC')->take(6)->get();
        $data['products'] = Product::join('item_enquiries', ['items.id' => 'item_enquiries.item_id'])
            ->where('items.service', false)
            ->orderBy('item_enquiries.created_at', 'ASC')->take(6)->get();
        return view("public.home", $data);
    }

    public function businesses($region_id = null)
    {
        $data['region'] = Region::find($region_id);
        $data['businesses'] = Shop::join('shop_contact_info', ['shops.id' => 'shop_contact_info.shop_id'])
                    ->join('streets', ['shop_contact_info.street_id' => 'streets.id'])
                    ->join('towns', ['towns.id' => 'streets.town_id'])
                    ->join('regions', ['regions.id' => 'towns.region_id'])
                    ->where('regions.id', $region_id)->select('shops.*')->paginate(20);
        return view("public.businesses", $data);
    }

    public function show_business($slug)
    {

        $data['shop'] = Shop::whereSlug($slug)->first();
        $data['branches'] = Shop::Where('parent_slug', $slug)->get();
        $data['products'] = $data['shop']->products->take(8);
        $data['services'] = $data['shop']->services->take(8);
        $data['related_shops'] = Shop::where('category_id', $data['shop']->category_id)->where('slug', '!=', $slug)->inRandomOrder()->get();
        // dd($data);
        return view("public.show_business", $data);
    }

    public function show_business_items($slug, $type)
    {
        $data['shop'] = Shop::whereSlug($slug)->first();
        $data['branches'] = Shop::Where('parent_slug', $slug)->get();
        switch ($type) {
            case '1':
                # code...
                $data['products'] = $data['shop']->products;
                $data['services'] = $data['shop']->services->take(6);
                break;
            case '2':
                # code...
                $data['products'] = $data['shop']->products->take(6);
                $data['services'] = $data['shop']->services;
                break;
        }
        // dd($data);
        return view("public.show_business_items", $data);
    }

    public function run_arrnd()
    {
        
        $data['regions'] = Region::orderBy('name')->get();
        $data['towns'] = Town::orderBy('name')->get();
        $data['streets'] = Street::orderBy('name')->get();
        // dd($data);
        return view('public.errands.create', $data);
    }

    public function run_arrnd_save(Request $request)
    {
        
        $data['categories'] = SubCategory::orderBy('name')->get();
        // dd($data);
        return view('public.errands.create_categ_images', $data);
    }

    public function run_arrnd_update(Request $request)
    {
        
        $data['business'] = Shop::first();
        $data['branches'] = $data['business']->branches;
        // dd($data);
        return view('public.errands.create_categ_images', $data);
    }

    public function search(Request $request)
    {
        $qstring = $request->searchString;

        if($qstring == null || strlen($qstring) == 0){
            return view('public.search');
        }
        $data['search_string'] = $qstring;
        $qstringTokens = explode(' ', $qstring);

        $qResult = [];

        $FullTextResults = \App\Models\Product::where('items.name', 'like', '%'.$qstring.'%')->inRandomOrder()->get();
        // $FullTextShopResults = \App\Models\Product::where('items.name', 'like', '%'.$qstring.'%')->join('shops', 'shops.id', '=', 'items.shop_id')->inRandomOrder()->select('shops.*')->get();
        
        // SEARCH FOR POSSIBLE BUSINESSES
        $qResultBuilder = \App\Models\Shop::join('items', 'items.shop_id', '=', 'shops.id')->where(function($qry)use($qstringTokens){
            $qry->where('search_index', 'LIKE', '%'.$qstringTokens[0].'%');
            foreach ($qstringTokens as $key => $token) {
                $qry->orWhere('search_index', 'LIKE', '%'.$token.'%')->orWhere('tags', 'LIKE', '%'.$token.'%');
            }
        });        
   
        $qResultShops = $qResultBuilder->whereNotIn('shops.id', $FullTextResults->pluck('shop_id')->toArray())->distinct()->get(['shops.*']);

        $data['products'] = $FullTextResults->all();
        $data['shops'] = $qResultShops->all();
        // dd($data);
        return view('public.search', $data);
    }


    public function errands(Request $request)
    {
        $data['regions'] = $this->regionService->getAllRegions();
        $data['errands'] = Errand::orderBy('created_at', 'ASC')->paginate(20);
        return view('public.errands.index')->with($data);
    }

    public function view_errand(Request $request)
    {
        $data['errand'] = Errand::first();
        if(auth()->user() != null)
            return view('public.errands.show', $data);
        return view('public.errands.preview', $data);
    }

    public function show_product($slug){
        $data['item'] = Product::whereSlug($slug)->first();
        return view('public.products.show', $data);
    }

    public function sub_category_businesses ($slug)
    {
        # code...
        $scat = \App\Models\SubCategory::whereSlug($slug)->first();
        $__shops = \App\Models\Shop::join('shop_categories', 'shop_categories.shop_id', '=', 'shops.id')->join('sub_categories', 'sub_categories.id', '=', 'shop_categories.sub_category_id')->where('sub_categories.slug', $slug)->select(['shops.*'])->distinct()->get();
        $__shops2 = \App\Models\Shop::join('sub_categories', 'sub_categories.id', '=', 'shops.category_id')->where('sub_categories.slug', $slug)->select(['shops.*'])->distinct()->get();
        $data['title'] = "Businesses under ".$scat->name??'';
        $data['businesses'] = collect(array_merge( $__shops->all(), $__shops2->all()));
        // $data['businesses'] = \App\Models\Shop::paginate(50);
        // dd($data);
        return view('public.category.scat_businesses', $data);
    }
}
