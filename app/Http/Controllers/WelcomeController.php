<?php

namespace App\Http\Controllers;

use App\Models\Errand;
use App\Models\Region;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Shop;


class WelcomeController extends Controller
{
    public function home()
    {
        return view("public.home");
    }

    public function businesses($region = null)
    {
        
        $data['businesses'] = Shop::all();
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
        $data['search_string'] = $qstring;
        $qstringTokens = explode(' ', $qstring);

        $qResult = [];
        $FullTextResults = \App\Models\Product::where('items.name', 'like', '%'.$qstring.'%')->inRandomOrder()->get();
        $FullTextShopResults = \App\Models\Product::where('items.name', 'like', '%'.$qstring.'%')->join('shops', 'shops.id', '=', 'items.shop_id')->inRandomOrder()->select('shops.*')->get();
        // $qResultBuilder = \App\Models\Product::where('name', '!=', null)->where(function($qry)use($qstringTokens){
        //     $qry->where('search_index', 'LIKE', '%'.$qstringTokens[0].'%');
        //     foreach ($qstringTokens as $key => $token) {
        //         $qry->orWhere('search_index', 'LIKE', '%'.$token.'%')->orWhere('tags', 'LIKE', '%'.$token.'%');
        //     }
        // });
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
        $qResultShops = $qShopResultBuilder->get(['shops.*']);
        

        // $data['products'] = array_unique(array_merge($FullTextResults->all(), $qResult->all()));
        $data['products'] = $FullTextResults->all();
        $data['shops'] =array_unique(array_merge($FullTextShopResults->all(), $qResultShops->all()));
        $data['shops'] =Shop::all();
        // dd($data);
        return view('public.search', $data);
    }


    public function errands(Request $request)
    {
        return view('public.errands.index');
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
