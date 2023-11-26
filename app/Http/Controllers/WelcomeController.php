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
        $FullTextShopResults = \App\Models\Product::where('items.name', 'like', '%'.$request.'%')->join('shops', 'shops.id', '=', 'items.shop_id')->inRandomOrder()->select('shops.*')->get();
        
        $qResultBuilder = \App\Models\Product::where('items.name', '!=', $qstring);
        foreach ($qstringTokens as $key => $token) {
            $qResultBuilder->orWhere('search_index', 'LIKE', '%'.$token.'%');
        }
        $qResult = $qResultBuilder->inRandomOrder()->get();
        $qResultShops = $qResultBuilder->join('shops', 'shops.id', '=', 'items.shop_id')->get(['shops.*']);
        

        $data['products'] = array_merge($FullTextResults->toArray(), $qResult->toArray());
        $data['shops'] =array_merge($FullTextShopResults->toArray(), $qResultShops->toArray());
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
