<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\Country;
use App\Models\Region;
use App\Models\Street;
use App\Models\Town;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function countries()
    {
        $contries = Country::orderBy('name', 'asc')->get();
        return response()->json([
            'data' => LocationResource::collection($contries)
        ]);
    }

    public function regions(Request $request)
    {
        $regions = Region::query();
        $regions = $regions->when($request->country_id, function ($query, $country_id) {
            $query->where('country_id', $country_id);
        });
        $regions = $regions->orderBy('name', 'asc')->get();
        return response()->json([
            'data' => LocationResource::collection($regions)
        ]);
    }

    public function towns(Request $request)
    {
        $towns = Town::query();
        $towns = $towns->when($request->region_id, function ($query, $region_id) {
            $query->where('region_id', $region_id);
        });
        $towns = $towns->orderBy('name', 'asc')->get();
        return response()->json([
            'data' => LocationResource::collection($towns)
        ]);
    }

    public function streets(Request $request)
    {
        $streets = Street::query();
        $streets = $streets->when($request->town_id, function ($query, $town_id) {
            $query->where('town_id', $town_id);
        });
        $streets = $streets->orderBy('name', 'asc')->get();
        return response()->json([
            'data' => LocationResource::collection($streets)
        ]);
    }
}
