<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Errand;
use App\Models\Town;
use Illuminate\Http\Request;

class ErrandController extends Controller
{
    public function index(Request $reuest)
    {
        # code...
        $data['title'] = "Errands";
        $data['errands'] = Errand::paginate(100);
        // dd($data);
        return view('admin.errands.index', $data);
    }

    public function reviews(Request $reuest)
    {
        # code...
        $data['title'] = "All Reviews";
        // $data['reviews'] = Town::all();
        $data['towns'] = Town::orderBy('name')->get();
        return view('admin.streets.create', $data);
    }

    public function delete_errand($errand_slug): \Illuminate\Http\RedirectResponse
    {
        $errand = Errand::whereSlug($errand_slug)->first();
        if($errand != null){
            $errand->delete();
            return back()->with('success', 'Successfully deleted');
        }
        return back()->with('error', 'Errand not found');
    }
}