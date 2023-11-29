<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Errand;
use App\Models\Product;
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
        
        $data['shop'] = Shop::whereSlug($slug)->first();
        $data['branches'] = Shop::Where('parent_slug', $slug)->get();
        $data['products'] = $data['shop']->products;
        $data['services'] = $data['shop']->services;
        $data['related_shops'] = Shop::where('category_id', $data['shop']->category_id)->inRandomOrder()->get();
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

    public function show_category($slug){
        $category = Category::whereSlug($slug)->first();
        $sub_categories = $category->sub_categories->sortBy('name');
        $items = Product::join('item_categories', 'item_categories.item_id', '=', 'items.id')->join('sub_categories', 'sub_categories.id', '=', 'item_categories.sub_category_id')->select('items.*')->distinct()->inRandomOrder()->get();
        $data['products'] = $items->where('service', 0)->all();
        $data['services'] = $items->where('service', 1)->all();
        $data['shops'] = Shop::join('sub_categories', 'sub_categories.id', '=', 'shops.category_id')->inRandomOrder()->get('shops.*')->all();
        return view('public.category', $data);
    }

}
