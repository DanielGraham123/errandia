<?php

namespace Modules\Regions\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Town;

use Modules\Location\Services\Interfaces\LocationService;
use Modules\Product\Services\ProductService;
use Modules\ProductCategory\Services\CategoryService;
use Modules\Regions\Entities\Regions;
use Modules\Street\Entities\Street;
use Modules\Location\Entities\Region;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    private $Regions;

    public function __construct(Regions $Regions, Street $Street)
    {
        $this->Regions = $Regions;
        $this->Street = $Street;
    }

    public function index()
    {
        return view('regions::index');
    }

    public function showTownPage()
    {
        $data['towns'] = Town::with('region.country')->get();
        $data['countries'] = Country::all();
        return view('regions::towns.index')->with($data);
    }

    public function getRegions(Request $req)
    {
        $countryId = $req["countryId"];
        $regions = Region::where('country_id', $countryId)->get();
        $arr = ['<option value="none">Select Region</option>'];
        foreach ($regions as $region) {
            array_push($arr, "<option value='" . $region->id . "'>" . $region->name . "</option>");
        }
        return $arr;
    }

    public function deleteTown(Request $req)
    {
        $id = $req["id"];
        Town::where('id', $id)->delete();
        $message = Session()->flash('message', 'town deleted with success');
        return redirect()->back()->with($message);
    }

    public function saveTown(Request $req)
    {
        $town = $req["town"];
        $region = $req["region"];
        if ($town == null) {
            return ["error", "<i class='fa fa-thumbs-down' style='font-size:12px'></i>&nbsp;&nbsp;<b style='color: red'>You entered an invalid town name. Please try again with a valid name.</b>"];
        }
        $twn = new Town();
        $twn->name = $town;
        $twn->region_id = $region;
        $twn->status = true;
        $twn->save();
        return ["success", "<i class='fa fa-thumbs-up' style='font-size:12px'></i>&nbsp;&nbsp;<b style='color: green'>Country added successfully.</b>"];
    }

    public function showUpdateTownPage($townId)
    {

    }

    public function updateTown(Request $request, $townId, LocationService $locationService)
    {
        $townName = $request->get('townName');
        $regionId = $request->get('region');
        $updateTown = array('name' => $townName, 'region_id' => $regionId);
        if ($locationService->updateTown($updateTown, $townId)) {
            return response()->json(["message" => "Town details updated successfully", "status" => "success"], 200);
        }
        return response()->json(["message" => "Unable to update town details. Kindly try again", "status" => "error"], 500);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('regions::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('regions::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('regions::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function showRegionsList()
    {
        $data['regions'] = $this->Regions->getRegions();
        return view('regions::regions', $data);
    }

    public function stores($region, CategoryService $categoryService,ProductService $productService)
    {
        $town =  $_REQUEST['town'] ?? 0;
        $category =$_REQUEST['category'] ?? 0;
        $street = $_REQUEST['street'] ?? 0;
        $searchCriteria = array( 'region' => intval( $region ), 'town' => $town, 'street' => $street);
        if ($category){
            $searchCriteria['categories'] = [$category];
        }
        $data['stores']  = $productService->getShopsBySubCategory($searchCriteria,true,true,true);
        $data['categories'] = $categoryService->getActiveSubCategories();
        $data['region'] =  DB::table('regions')->where('id', $region)->first();
        $data['request']['town'] = $town;
        $data['request']['street'] = $street;
        $data['request']['category'] = $category;
        $data['towns'] = DB::table('towns')->where('region_id', $region)->get();
        $data['streets'] = DB::table('streets')
            ->join('towns', 'streets.town_id', '=', 'towns.id')
            ->where('towns.region_id', $region)
            ->select('streets.*')
            ->get();

        if ($town) {
            $data['streets'] = DB::table('streets')->where('town_id', $town)->get();
        }
        return view('regions::stores', $data);
    }
}
