<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:32 PM
 */

namespace Modules\Location\Repositories\Interfaces;

interface CountryRepository
{
    public function create(array $country);

    public function findById($country_id);

    public function update(array $country, $country_id);

    public function delete($country_id);

    public function getAll();
}