<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 9:21 PM
 */

namespace Modules\Location\Services\Interfaces;

use Illuminate\Support\Facades\Request;

interface LocationService
{
    //Manage countries
    public function saveCountry(array $country);

    public function findCountryById($country_id);

    public function updateCountry(array $country, $country_id);

    public function deleteCountry($country_id);

    public function getAllCountry();

    //manage regions
    public function saveRegion(array $region);

    public function findRegionById($region_id);

    public function updateRegion(array $region, $region_id);

    public function deleteRegion($region_id);

    public function getAllRegions();

    //manage towns
    public function saveTown(array $town);

    public function findTownById($town_id);

    public function updateTown(array $town, $town_id);

    public function deleteTown($town_id);

    public function getAllTowns();

    public function getTownByRegion(Request $request);

    // manage streets
    public function getAllStreets();

    public function getStreetByTown(Request $request);

    public function findStreetById($street_id);
}
