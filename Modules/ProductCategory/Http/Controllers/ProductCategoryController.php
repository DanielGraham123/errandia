<?php

namespace Modules\ProductCategory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductCategory\Http\Requests\CreateCategoryRequest;
use Modules\ProductCategory\Http\Requests\UpdateCategoryRequest;
use Modules\ProductCategory\Services\CategoryService;
use Modules\Utility\Services\ImageUploadService;
use Modules\Utility\Services\UtilityService;

class ProductCategoryController extends Controller
{
    private $categoryService;
    private $utilityService;

    public function __construct(CategoryService $categoryService, UtilityService $utilityService)
    {
        $this->categoryService = $categoryService;
        $this->utilityService = $utilityService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('productcategory::index')
            ->with(['categories' => $this->categoryService->getAllCategories()]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('productcategory::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCategoryRequest $request)
    {

        $categoryData = $request->getCategoryData();
        $categoryData['slug'] = $this->utilityService->generateRandSlug();
        $categoryData['status'] = 1;
        //save data
        $category_id = $this->categoryService->saveCategory($categoryData);
        if ($category_id) {
            session()->flash('success', trans('admin.category_add_success_msg'));
            return redirect()->back();
        }
        return redirect()->back()->withErrors([trans('admin.category_add_error_msg')]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($slug)
    {
        $category = $this->categoryService->findCategoryBySlug($slug);
        if (empty($category)) {
            return redirect()->route('categories')
                ->withErrors([trans('admin.category_not_found')]);
        }
        //find category sub categories
        $sub_categories = $this->categoryService->getSubCategoriesByCategory($category->id);
        return view('productcategory::show')->with(['categories' => $sub_categories, 'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($slug)
    {
        $category = $this->categoryService->findCategoryBySlug($slug);
        if (empty($category)) {
            return redirect()->route('categories')
                ->withErrors([trans('admin.category_not_found')]);
        }
        return view('productcategory::edit')->with(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {
        $category = $this->categoryService->findCategoryBySlug($slug);
        if (empty($category)) {
            return redirect()->route('categories')
                ->withErrors([trans('admin.category_not_found')]);
        }
        $categoryDatails = $request->getCategoryData();
        $updateCategory = $this->categoryService->updateCategory($category->id, $categoryDatails);
        if ($updateCategory) {
            return redirect()->route('categories')
                ->with(['success' => trans('admin.category_updated_success_msg')]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($slug, ImageUploadService $imageUploadService)
    {
        //
        $category = $this->categoryService->findCategoryBySlug($slug);
        if (empty($category)) return redirect()
            ->route('categories')
            ->withErrors([trans('admin.category_not_found')]);
        //check if category has products registered under
        $hasSubCategories = $this->categoryService->getSubCategoriesByCategory($category->id);
        if (!$hasSubCategories->isEmpty()) return redirect()
            ->route('categories')->withErrors([trans('admin.category_delete_has_sub_category')]);

        //delete category
        $this->categoryService->deleteCategory($category->id);
        //delete image from filesystem
        $imageUploadService->deleteFile($category->image_path);
        //redirect to list
        return redirect()->route('categories')
            ->with(['success' => trans('admin.category_delete_success_msg')]);
    }

    /*
     * @Manage sub categories
     */

    public function addSubCategoryForm($category)
    {
        $category = $this->categoryService->findCategoryBySlug($category);
        if (empty($category)) return redirect()
            ->route('categories')
            ->withErrors([trans('admin.category_not_found')]);
        return view('productcategory::subcategory.create')->with(['category' => $category]);
    }

    public function saveSubCategory(CreateCategoryRequest $request, $category)
    {
        $category_exist = $this->categoryService->findCategoryBySlug($category);
        if (empty($category_exist)) return redirect()
            ->route('categories')
            ->withErrors([trans('admin.category_not_found')]);
        $categoryData = $request->getCategoryData();
        $categoryData['slug'] = $this->utilityService->generateRandSlug();
        $categoryData['status'] = 1;
        $categoryData['category_id'] = $category_exist->id;
        //save data
        $sub_category = $this->categoryService->saveSubCategory($categoryData);
        if ($sub_category) {
            session()->flash('success', trans('admin.category_add_success_msg'));
            return redirect()->back();
        }
        return redirect()->back()->withErrors([trans('admin.category_add_error_msg')]);
    }

    public function editSubCategoryForm($category, $sub_category)
    {
        $category_exist = $this->categoryService->findSubCategoryBySlug($sub_category);
        if (empty($category_exist)) return redirect()
            ->back()
            ->withErrors([trans('admin.category_not_found')]);
        return view('productcategory::subcategory.edit')->with(['category' => $category_exist, 'category_slug' => $category]);
    }

    public function updateSubCategory(UpdateCategoryRequest $request, $category, $sub_category)
    {
        $category_exist = $this->categoryService->findSubCategoryBySlug($sub_category);
        if (empty($category_exist)) return redirect()
            ->back()
            ->withErrors([trans('admin.category_not_found')]);
        $categoryDetails = $request->getCategoryData();
        $updateCategory = $this->categoryService->updateSubCategory($category_exist->id, $categoryDetails);
        if ($updateCategory) {
            return redirect()->route('show_category', ['id' => $category])
                ->with(['success' => trans('admin.category_updated_success_msg')]);
        }
    }

    public function deleteSubCategory($category, $sub_category, ImageUploadService $imageUploadService)
    {
        $category_exist = $this->categoryService->findSubCategoryBySlug($sub_category);
        if (empty($category_exist)) return redirect()
            ->back()
            ->withErrors([trans('admin.category_not_found')]);
        //check if sub category has products attached
        $categoryHasProducts = $this->categoryService->findProductsBySubCategory($category_exist->id);
        if (!$categoryHasProducts->isEmpty()) return redirect()
            ->route('categories')->withErrors([trans('admin.category_delete_has_products')]);
        //delete sub category
        $this->categoryService->deleteSubCategory($category_exist->id);
        //delete image from filesystem
        $imageUploadService->deleteFile($category_exist->image_path);

        return redirect()->route('show_category', ['id' => $category])
            ->with(['success' => trans('admin.category_updated_success_msg')]);
    }

    public function getSubCategoriesByCat(Request $request)
    {
        $request->validate(['category' => 'required|not_in:none']);
        $data = $this->categoryService->getSubCategoriesByCategoryOptions($request->get('category'));
        return json_encode(['state' => 'success', 'data' => $data]);
    }
}
