<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function categories (Request $request)
    {
        # code...
        $data['title'] = "All Categories";
        $data['categories'] = \App\Models\Category::all();
        return view('admin.categories.index', $data);
    }

    public function sub_categories(Request $request)
    {
        # code...
        $data['title'] = "All Sub-Categories";
        $data['sub_categories'] = SubCategory::all();
        return view('admin.categories.subcategories.index', $data);
    }

    public function create_sub_category(Request $request)
    {
        # code...
        $data['title'] = "Create New Sub-Category";
        $data['categories'] = Category::all();
        return view('admin.categories.subcategories.create', $data);
    }

    // TODO: SAVE SUB-CATEGORY

    public function create_category(Request $request)
    {
        # code...
        $data['title'] = "Create New Category";
        return view('admin.categories.create', $data);
    }
}