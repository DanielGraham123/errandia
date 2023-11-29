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
use Illuminate\Support\Facades\Auth;
use \App\Models\Shop;


class WelcomeController extends Controller
{
    private $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    public function home()
    {
        $data['errands'] = Errand::orderBy('created_at', 'ASC')->take(12)->get();
        return view("public.home", $data);
    }

    public function businesses($region = null)
    {
        $data['businesses'] = Shop::paginate(10);
        return view("public.businesses", $data);
    }

    public function show_business($slug)
    {
        
        $data['business'] = Shop::first();
        $data['branches'] = $data['business']->branches;
        // dd($data);
        return view("public.show_business", $data);
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
        if($qstring == null){
            return view('public.search');
        }
        $data['search_string'] = $qstring;
        $qstringTokens = explode(' ', $qstring);

        $qResult = [];
        $FullTextResults = Product::where('items.name', 'like', '%'.$qstring.'%')->inRandomOrder()->get();
        $FullTextShopResults = Product::where('items.name', 'like', '%'.$qstring.'%')->join('shops', 'shops.id', '=', 'items.shop_id')->inRandomOrder()->select('shops.*')->get();
        
        
        $qShopResultBuilder = Shop::join('shop_categories', 'shop_categories.shop_id', '=', 'shops.id')
            ->join('sub_categories', 'sub_categories.id', '=', 'shop_categories.sub_category_id')
            ->where(function($qry)use($qstringTokens){
                $qry->where('sub_categories.description', 'LIKE', '%'.$qstringTokens[0].'%');
                foreach ($qstringTokens as $key => $token) {
                    $qry->orWhere('sub_categories.description', 'LIKE', '%'.$token.'%');
                }
            })->orWhere(function($qry)use($qstringTokens){
                $qry->join('sub_categories', 'shops.category_id', '=', 'sub_categories.id')
                    ->where('sub_categories.description', 'LIKE', '%'.$qstringTokens[0].'%');
                    foreach ($qstringTokens as $key => $token) {
                        $qry->orWhere('sub_categories.description', 'LIKE', '%'.$token.'%');
                    }
            });
        // $qResult = $qResultBuilder->inRandomOrder()->get();
        $qResultShops = $qShopResultBuilder->whereNotIn('shops.id', $FullTextResults->pluck('shop_id')->toArray())->get(['shops.*']);

        // $data['products'] = array_unique(array_merge($FullTextResults->all(), $qResult->all()));
        $data['products'] = $FullTextResults->all();
        $data['shops'] = $qResultShops->all();
        $data['shops'] =Shop::all();
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
        return view('public.products.show');
    }

}
