<?php

namespace App\Http\Controllers;

use App\Models\Errand;
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
        
        $data['business'] = Shop::where('slug', $slug)->first();
        $data['branches'] = $data['business']->branches;
        $data['products'] = $data['business']->products;
//         dd($data);
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
        
        $data['results'] = Shop::first();
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
