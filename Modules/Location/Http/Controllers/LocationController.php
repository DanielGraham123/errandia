<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Http\Requests\CreateCountryRequest;
use Modules\Location\Http\Requests\CreateRegionRequest;
use Modules\Location\Http\Requests\CreateTownRequest;
use Modules\Location\Http\Requests\UpdateCountryRequest;
use Modules\Location\Http\Requests\UpdateRegionRequest;
use Modules\Location\Http\Requests\UpdateTownRequest;
use Modules\Location\Services\Interfaces\LocationService;

class LocationController extends Controller
{
    private $locationService;

    /**
     * LocationController constructor.
     * @param $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function showCountriesPage()
    {
        $data['countries'] = $this->locationService->getAllCountry();
        return view('location::index')->with($data);
    }

    public function showCreateCountryPage()
    {
        return view('location::create');
    }

    public function saveCountry(CreateCountryRequest $request)
    {
        //
    }

    public function showEditCountryPage($country_id)
    {
        return view('location::show');
    }

    public function updateCountry(UpdateCountryRequest $request, $country_id)
    {

    }

    public function deleteCountry($country_id)
    {

    }

    //manage regions
    public function showRegionsPage()
    {
        $data['regions'] = $this->locationService->getAllRegions();
        return view('location::index')->with($data);
    }

    public function showCreateRegionPage()
    {
        return view('location::create');
    }

    public function saveRegion(CreateRegionRequest $request)
    {
        //
    }

    public function showEditRegionPage($region_id)
    {
        return view('location::show');
    }

    public function updateRegion(UpdateRegionRequest $request, $region_id)
    {

    }

    public function deleteRegion($region_id)
    {

    }

    //manage towns
    public function showTownsPage()
    {
        $data['regions'] = $this->locationService->getAllTowns();
        return view('location::index')->with($data);
    }

    public function showCreateTownPage()
    {
        return view('location::create');
    }

    public function saveTown(CreateTownRequest $request)
    {
        //
    }

    public function showEditTownPage($town_id)
    {
        return view('location::show');
    }

    public function updateTown(UpdateTownRequest $request, $town_id)
    {

    }

    public function deleteTown($town_id)
    {

    }

	public function getTownByRegion(Request $request)
    {
        $request->validate(['region' => 'required|not_in:none']);
        $data = $this->locationService->getTownByRegionOptions($request->get('region'));
        return json_encode(['state' => 'success', 'data' => $data]);
    }

	public function getStreetByTown(Request $request)
    {
        $request->validate(['town' => 'required|not_in:none']);
        $data = $this->locationService->getStreetByTownOptions($request->get('town'));
        return json_encode(['state' => 'success', 'data' => $data]);
    }
}
