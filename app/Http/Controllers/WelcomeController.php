<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Errand;
use App\Models\ErrandImage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Region;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Town;
use App\Services\GeographicalService\RegionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use \App\Models\Shop;


class WelcomeController extends Controller
{
    const ERRAND_IMAGE_PATH = "uploads/quote_images";
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
        $data['errands'] = Errand::orderBy('id', 'DESC')->take(6)->get();
        $data['services'] = Product::where('items.service', true)
                            ->orderBy('items.views', 'DESC')->take(6)->get();
        $data['products'] = Product::where('items.service', false)
            ->orderBy('items.views', 'DESC')->take(6)->get();
        return view("public.home", $data);
    }

    public function businesses(Request $request, $region_id = null)
    {
        $data['regions'] = $this->regionService->getAllRegions();
        $data['region'] = Region::find($region_id);
        $region_id = isset($request['region_id']) ? $request['region_id'] : $region_id;
        $town_id   = isset($request['town_id']) ? $request['town_id'] : null;
        $street_id = isset($request['street_id']) ? $request['street_id'] : null;
        $orderBy = isset($request['orderBy']) ? $request['orderBy'] : null;
        $businesses = Shop::join('shop_contact_info', ['shops.id' => 'shop_contact_info.shop_id'])
                    ->join('streets', ['shop_contact_info.street_id' => 'streets.id'])
                    ->join('towns', ['towns.id' => 'streets.town_id'])
                    ->join('regions', ['regions.id' => 'towns.region_id']);
        if(is_null($region_id)){
            $data['businesses'] = $businesses->select('shops.*')->paginate(20);
        }else {
            $businesses = $businesses->where('regions.id', $region_id);
            if(!is_null($town_id) && $town_id != "Town"){
                $businesses = $businesses->Where('towns.id', $town_id);
            }
            if(!is_null($street_id) && $street_id !="Street") {
                $businesses = $businesses->Where('streets.id', $street_id);
            }
            $data['businesses'] = $businesses->select('shops.*')->orderBy('shops.created_at', 'DESC')->paginate(20);
        }
        if(!is_null($orderBy)) {
            $data['businesses'] = $businesses->select('shops.*')->orderBy('shops.name', $orderBy)->paginate(20);
        }

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

        return view('public.errands.create', $data);
    }

    public function run_arrnd_save(Request $request)
    {
        ($savedErrand = (new Errand([
            'title' => $request['title'],
            'description' => $request['description'],
            'region_id' => $request['region'],
            'town_id'   => $request['town'],
            'street_id' => $request['street'] == "Street"? '':$request['street']
        ])))->save();
        $data['categories'] = SubCategory::orderBy('name')->get();
        $data['errand'] = $savedErrand;
        return view('public.errands.create_categ_images', $data);
    }

    private function generateErrandSubCategoryList($subCategories) {
        $subCategoryList = "";
        foreach ($subCategories as $category){
            $subCategoryList .= $category. "-";
        }
        return $subCategoryList;
    }

    private function uploadErrandGallery(Request $request, $errand)
    {
         foreach($request['images'] as $image)
         {
             $imageName = time().'.'.$image->getClientOriginalName();
             $image->move(public_path(self::ERRAND_IMAGE_PATH.'/'.$errand->title.'/images/'), $imageName);

             ErrandImage::create([
                 'item_quote_id' => $errand->id,
                 'image'         => self::ERRAND_IMAGE_PATH.'/'.$errand->title.'/images/'.$imageName,
                 'created_at'    => Carbon::now(),
                 'updated_at'    => Carbon::now()
             ]);
         }
    }
    public function run_arrnd_update(Request $request)
    {
        $errand = Errand::find($request['errand']);
        $errand->update([
            'sub_categories' => $this->generateErrandSubCategoryList($request['categories']),
            'slug'           => 'bDC'.time().'swI'.mt_rand(100000, 999999).'fgUfre'
        ]);
        $this->uploadErrandGallery($request, $errand);

        return redirect()->route('public.errands');
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
        $region_id = isset($request['region_id']) ? $request['region_id'] : null;
        $town_id   = isset($request['town_id']) ? $request['town_id'] : null;
        $street_id = isset($request['street_id']) ? $request['street_id'] : null;
        $orderBy = isset($request['orderBy']) ? $request['orderBy']:null;
        $data['regions'] = $this->regionService->getAllRegions();
        $data['region'] = Region::find($region_id);
      
        if(is_null($region_id)){
            $errands = Errand::orderBy('created_at', 'DESC')->where('read_status', 0)->where('status', 1)->where(function($query){
                  auth()->check() ? $query->where('user_id', '!=', auth()->id()) : null; });
        }else {
            $errands = Errand::where('region_id', $region_id)->where('read_status', 0)->where('status', 1)->where(function($query){
                    auth()->check() ? $query->where('user_id', '!=', auth()->id()) : null; });

            if(!is_null($town_id) && $town_id != "Town"){
                $errands = $errands->Where('town_id', $town_id);
            }
            if(!is_null($street_id) && $street_id !="Street") {
                $errands = $errands->Where('street_id', $street_id);
            }
        }
        if(!is_null($orderBy)){
            $errands = Errand::orderBy('title', $orderBy);
        }
        $data['errands'] = $errands->paginate(20);
        return view('public.errands.index')->with($data);
    }

    public function view_errand(Request $request)
    {
        $errand = Errand::whereSlug($request->slug)->first();
//        dd($errand->getSubcategories());
        $data['errand'] = $errand;
        if(auth()->user() != null)
            return view('public.errands.show', $data);
        return view('public.errands.preview', $data);
    }

    private function getErrandSubcategories($categories)
    {
        dd($categories->explode("-"));
    }

    public function show_product($slug){
        $item = Product::whereSlug($slug)->first();
        $data['item'] = $item;
        $reviews = $item->reviews();
        $_reviews_sum = $item->reviews()->sum('rating');
        $reviews_sum = $_reviews_sum == 0 ? 1 : $_reviews_sum;
        $reviews_count = $reviews->count() == 0 ? 1 : $reviews->count();
        $data['average_rating'] = round($reviews->sum('rating')/$reviews_count);
        $data['rating5'] = round(($item->reviews()->where('rating', 5)->sum('rating')/$reviews_sum)*100);
        $data['rating4'] = round(($item->reviews()->where('rating', 4)->sum('rating')/$reviews_sum)*100);
        $data['rating3'] = round(($item->reviews()->where('rating', 3)->sum('rating')/$reviews_sum)*100);
        $data['rating2'] = round(($item->reviews()->where('rating', 2)->sum('rating')/$reviews_sum)*100);
        $data['rating1'] = round(($item->reviews()->where('rating', 1)->sum('rating')/$reviews_sum)*100);

        $reported = \App\Models\ReviewReport::pluck('review_id')->toArray();
        $data['reviews'] = $item->reviews()->whereNotIn('id', $reported)->get();

        $data['shop_reviews'] = $item->shop->items()->join('reviews', 'reviews.item_id', '=', 'items.id')->count();
        // dd($data);
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

    public function review_product($slug)
    {
        $item = Product::whereSlug($slug)->first();
        if($item !=  null){
            $data['title'] = "Product Review";
            $data['item'] = $item;
            $data['shop_reviews'] = $item->shop->items()->join('reviews', 'reviews.item_id', '=', 'items.id')->count();
            return view('public.products.review', $data);
        }
    }

    public function save_product_review(Request $request, $slug)
    {
        $prod = Product::whereSlug($slug)->first();
        $user = auth()->user();

        $request->validate(['rating'=>'required', 'images'=>'array', 'review'=>'required']);
        $data = ['buyer_id'=>$user->id, 'item_id'=>$prod->id, 'rating'=>$request->rating, 'review'=>nl2br($request->review)];

        if($user->id == $prod->shop->user_id){
            session()->flash('error', 'You are not allowed to review your products.');
            return back()->withInput();
        }
        if(\App\Models\Review::where(['buyer_id'=>$user->id, 'item_id'=>$prod->id])->count() > 0){
            session()->flash('error', 'You have already reviewed this product.');
            return back()->withInput();
        }
        
        ($review = (new \App\Models\Review($data)))->save();

        if(($images = $request->file('images')) != null){
            $rev_imgs = [];
            foreach ($images as $key => $image) {
                $path = public_path('uploads/review_images');
                $fname = 'review_'.time().'_'.random_int(100000, 999999).'.'.$image->getClientOriginalExtension();
                $image->move($path, $fname);
                $rev_imgs[] = ['review_id'=>$review->id, 'image'=>$fname];
            }
            \App\Models\ReviewImage::insert($rev_imgs);
        }
        return redirect()->route('public.products.show', $slug);
    }



    public function report_review_save(Request $request, $id)
    {
        # code...
        $validity = \Illuminate\Support\Facades\Validator::make($request->all(), ['reason'=>'required']);
        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }
        $review = \App\Models\Review::find($id);
        $report = new \App\Models\ReviewReport(['review_id'=>$id, 'reason'=>nl2br($request->reason)]);
        $report->save();

        return redirect()->route('public.products.show', $review->product->slug);
    }

    public function delete_review($id)
    {
        # code...
        try {
            //code...
            $review = \App\Models\Review::find($id);
            if($review != null){
                if($review->user->id == auth()->id()){
                    foreach ($review->images as $key => $image) {
                        try {
                            //code...
                            unlink(public_path('uploads/review_images/').$image->image);
                        } catch (\Throwable $th) {
                            continue;
                        }
                    }
                    $review->delete();
                }else{
                    return back()->with('error', "Your are not allowed to delete this review.");
                }
            }
            return back()->with('success', "Operation completed");
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
