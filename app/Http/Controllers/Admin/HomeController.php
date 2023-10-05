<?php


namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CampusSemesterConfig;
use App\Models\Config;
use App\Models\File;
use App\Models\PlatformCharge;
use App\Models\Resit;
use App\Models\SchoolContact;
use App\Models\SchoolUnits;
use App\Models\Semester;
use App\Models\Students;
use App\Models\Subjects;
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
}
