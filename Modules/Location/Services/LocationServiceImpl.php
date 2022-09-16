<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 9:27 PM
 */

namespace Modules\Location\Services;

use Modules\Location\Repositories\Interfaces\CountryRepository;
use Modules\Location\Repositories\Interfaces\RegionRepository;
use Modules\Location\Repositories\Interfaces\TownRepository;
use Modules\Location\Repositories\Interfaces\StreetRepository;
use Modules\Location\Services\Interfaces\LocationService;

class LocationServiceImpl implements LocationService
{
    protected $countryRepository;
    protected $regionRepository;
    protected $townRepository;
    protected $streetRepository;

    /**
     * LocationServiceImpl constructor.
     * @param $countryRepository
     * @param $regionRepository
     * @param $townRepository
     */
    public function
    __construct(CountryRepository $countryRepository,
                RegionRepository $regionRepository,
                TownRepository $townRepository,
                StreetRepository $streetRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->regionRepository = $regionRepository;
        $this->townRepository = $townRepository;
        $this->streetRepository = $streetRepository;
    }

    public function saveCountry(array $country)
    {
        return $this->countryRepository->create($country);
    }

    public function updateCountry(array $country, $country_id)
    {
        return $this->countryRepository->update($country, $country_id);
    }

    public function findCountryById($country_id)
    {
        return $this->countryRepository->findById($country_id);
    }

    public function deleteCountry($country_id)
    {
        return $this->countryRepository->delete($country_id);
    }

    public function getAllCountry()
    {
        return $this->countryRepository->getAll();
    }

    //Manage regions
    public function saveRegion(array $region)
    {
        return $this->regionRepository->create($region);
    }

    public function findRegionById($region_id)
    {
        return $this->regionRepository->findById($region_id);
    }

    public function updateRegion(array $region, $region_id)
    {
        return $this->regionRepository->update($region, $region_id);
    }

    public function deleteRegion($region_id)
    {
        return $this->regionRepository->delete($region_id);
    }

    public function getAllRegions()
    {
        return $this->regionRepository->getAll();
    }

    //manage towns
    public function saveTown(array $town)
    {
        return $this->townRepository->create($town);
    }

    public function findTownById($town_id)
    {
        return $this->townRepository->findById($town_id);
    }

    public function updateTown(array $town, $town_id)
    {
        return $this->townRepository->update($town, $town_id);
    }

    public function deleteTown($town_id)
    {
        return $this->townRepository->delete($town_id);
    }

    public function getAllTowns()
    {
        return $this->townRepository->getAll();
    }

    public function getAllStreets()
    {
        return $this->streetRepository->getAll();
    }

    // FOR TOWN
    public function getTownByRegion($region_id)
    {
        return $this->townRepository->getTownByRegion($region_id);
    }

    public function getTownByRegionOptions($region_id)
    {
        $towns = $this->getTownByRegion($region_id);
        $data = "<option value='none'>" . trans('shop.add_shop_select_town') . "</option>";
        foreach ($towns as $town) {
            $data .= "<option value='" . $town->id . "'>" . $town->name . "</option>";
        }
        return $data;
    }

    // FOR STREET
    public function getStreetByTown($town_id)
    {
        return $this->streetRepository->getStreetByTown($town_id);
    }

    public function getStreetByTownOptions($town_id)
    {
        $streets = $this->getStreetByTown($town_id);
        $data = "<option value='none'>Select Street</option>";
        foreach ($streets as $street) {
            $data .= "<option value='" . $street->id . "'>" . $street->name . "</option>";
        }
        return $data;
    }

    public function findStreetById($street_id)
    {
        return $this->streetRepository->findById($street_id);
    }
}
