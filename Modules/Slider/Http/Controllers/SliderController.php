<?php

namespace Modules\Slider\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Subscription\Http\Requests\AddEnquiryRequest;
use Modules\ProductCategory\Services\CategoryService;
use Modules\ProductCategory\Entities\SubCategory;
use Illuminate\Routing\Controller;
use Modules\Utility\Services\ImageUploadService;

use Modules\Slider\Entities\Slider;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
	private $Slider;
	public function __construct(Slider $Slider, CategoryService $categoryService,SubCategory $SubCategory)
    {
        $this->Slider = $Slider;
		$this->categoryService = $categoryService;
        $this->SubCategory = $SubCategory;
    }

    public function index()
    {
        $data['sliders'] = $this->Slider->getAllSlider();
		return view('slider::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // FOR SORT CATEGORY SUB CATEGORY
		$data['request']['category'] = $_REQUEST['subcategory'] = 0;
		$data['request']['sub_category']='';
        $data['categories'] = $this->categoryService->getAllCategories();
        $data['SubCategories'] = $this->SubCategory->getAllSubCategories();
		return view('slider::create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(ImageUploadService $imageUploadService,AddEnquiryRequest $request)
    {
       	$extraProductImages = $request->getProductEnquiryImages();
		if (count($extraProductImages) > 0) {
			foreach ($extraProductImages as $image) {
				$imagePath = $imageUploadService->uploadHomeSlider($image, key($image), "sliders");
				$sliderData['image']=$imagePath;
				$sliderData['caption']=$_POST['caption'];
				$sliderData['category']=$_POST['category'];
				$sliderData['sub_category']=$_POST['sub_category'];
				$sliderData['duration']=$_POST['duration'];
				$sliderData['status']=1;
				$sliderData['created_at']=date("Y-m-d h:i:s");
				$sliderData['updated_at']=date("Y-m-d h:i:s");
				$this->Slider->saveSlider($sliderData);
			}
		}
		session()->flash('success', trans('admin.slider_add_success_msg'));
        return redirect()->route('slider');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('slider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $slider = $this->Slider->findSliderByID($id);
        if (empty($slider)) {
            return redirect()->route('slider')
                ->withErrors([trans('admin.category_not_found')]);
        }
		$data['slider']=$slider;
		$data['request']['category'] = $_REQUEST['subcategory'] = 0;
		$data['request']['sub_category']='';
        $data['categories'] = $this->categoryService->getAllCategories();
        $data['SubCategories'] = $this->SubCategory->getAllSubCategories();
		return view('slider::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ImageUploadService $imageUploadService,AddEnquiryRequest $request,$id)
    {
		$sliderData['caption']=$_POST['caption'];
		$sliderData['category']=$_POST['category'];
		$sliderData['sub_category']=$_POST['sub_category'];
		$sliderData['duration']=$_POST['duration'];
		$sliderData['status']=1;
		$sliderData['created_at']=date("Y-m-d h:i:s");
		$sliderData['updated_at']=date("Y-m-d h:i:s");

		$extraProductImages = $request->getProductEnquiryImages();
		if (count($extraProductImages) > 0) {
			foreach ($extraProductImages as $image) {
				$imagePath = $imageUploadService->uploadHomeSlider($image, key($image), "sliders");
				$sliderData['image']=$imagePath;
			}
		}
		$updateSlider = $this->Slider->updateSlider($id,$sliderData);
        if ($updateSlider) {
            return redirect()->route('slider')
                ->with(['success' => trans('admin.slider_updated_success_msg')]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->Slider->deleteSlider($id);
        //redirect to list
        return redirect()->route('slider')
            ->with(['success' => trans('admin.slider_delete_success_msg')]);
    }
}

?>
