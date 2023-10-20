<?php


namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CampusSemesterConfig;
use App\Models\Category;
use App\Models\Config;
use App\Models\Errand;
use App\Models\File;
use App\Models\PlatformCharge;
use App\Models\Region;
use App\Models\Resit;
use App\Models\SchoolContact;
use App\Models\SchoolUnits;
use App\Models\Semester;
use App\Models\ShopSubscription;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\Town;
use App\Models\User;
use App\Models\Wage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HomeController  extends Controller
{
    public function index()
    {

        $data['title'] = "Dashboard";
        return view('admin.dashboard', $data);
    }


    public function block_user($user_id)
    {
        # code...
        $user = User::find($user_id);
        if($user != null){
            $update = ['active'=>0, 'activity_changed_by'=>auth()->id(), 'activity_changed_at'=>now()->format(DATE_ATOM)];
            $user->update($update);
        }
        return back()->with('success', __('text.word_Done'));
    }

    public function activate_user($user_id)
    {
        # code...
        $user = User::find($user_id);
        if($user != null){
            $update = ['active'=>1, 'activity_changed_by'=>auth()->id(), 'activity_changed_at'=>now()->format(DATE_ATOM)];
            $user->update($update);
        }
        return back()->with('success', __('text.word_Done'));
    }

    public function errands(Request $reuest)
    {
        # code...
        $data['title'] = "Errands";
        $data['errands'] = Errand::paginate(100);
        // dd($data);
        return view('admin.errands.index', $data);
    }

    public function businesses(Request $reuest)
    {
        # code...
        $data['title'] = "Businesses";
        return view('admin.businesses.index', $data);
    }

    public function create_business(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Business";
        return view('admin.businesses.create', $data);
    }
    public function create_business_branch(Request $reuest, $business = null)
    {
        # code...
        $data['title'] = "Create New Business Branch";
        return view('admin.businesses.branches.create', $data);
    }
    public function show_business(Request $reuest, $business = null)
    {
        # code...
        $data['title'] = "Business Details";
        return view('admin.businesses.show', $data);
    }

    public function products(Request $reuest)
    {
        # code...
        $data['title'] = "All Products";
        return view('admin.products.index', $data);
    }


    public function create_products(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Product";
        return view('admin.products.create', $data);
    }

    public function show_product(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Product";
        return view('admin.products.show', $data);
    }

    public function services(Request $reuest)
    {
        # code...
        $data['title'] = "All Services";
        return view('admin.services.index', $data);
    }

    public function show_service(Request $reuest)
    {
        # code...
        $data['title'] = "Service Details";
        return view('admin.services.show', $data);
    }

    public function create_service(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Services";
        return view('admin.services.create', $data);
    }
    
    public function categories (Request $reuest)
    {
        # code...
        $data['title'] = "All Categories";
        $data['categories'] = \App\Models\Category::all();
        return view('admin.categories.index', $data);
    }

    public function create_category(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Category";
        return view('admin.categories.create', $data);
    }

    public function sub_categories(Request $reuest)
    {
        # code...
        $data['title'] = "All Sub-Categories";
        $data['sub_categories'] = SubCategory::all();
        return view('admin.categories.subcategories.index', $data);
    }

    public function create_sub_category(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Sub-Category";
        $data['categories'] = Category::all();
        return view('admin.categories.subcategories.create', $data);
    }

    public function towns(Request $reuest)
    {
        # code...
        $data['title'] = "All Towns";
        $data['towns'] = Town::all();
        return view('admin.towns.index', $data);
    }

    public function streets(Request $reuest)
    {
        # code...
        $data['title'] = "All Streets";
        $data['streets'] = Street::all();
        return view('admin.streets.index', $data);
    }

    public function create_town(Request $reuest)
    {
        # code...
        $data['title'] = "Create Town";
        $data['regions'] = Region::all();
        return view('admin.towns.create', $data);
    }

    public function create_street(Request $reuest)
    {
        # code...
        $data['title'] = "Create New Street";
        $data['towns'] = Town::all();
        return view('admin.streets.create', $data);
    }

    public function reviews(Request $reuest)
    {
        # code...
        $data['title'] = "All Reviews";
        // $data['reviews'] = Town::all();
        return view('admin.streets.create', $data);
    }

    public function subscription_plans (Request $reuest)
    {
        # code...
        $data['title'] = "All Subscription Plans";
        $data['plans'] = Subscription::all();
        return view('admin.subscriptions.index', $data);
    }

    public function create_subscription_plan (Request $reuest)
    {
        # code...
        $data['title'] = "Add New Subscription Plan";
        return view('admin.subscriptions.create', $data);
    }

    public function subscription_report (Request $reuest)
    {
        # code...
        $data['title'] = "All Subscriptions";
        $data['subscriptions'] = ShopSubscription::all();
        return view('admin.reports.subscriptions', $data);
    }
}
