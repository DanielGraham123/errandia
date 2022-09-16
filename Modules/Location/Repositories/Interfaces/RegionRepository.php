<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:36 PM
 */

namespace Modules\Location\Repositories\Interfaces;


interface RegionRepository
{
    public function create(array $region);

    public function findById($region_id);

    public function update(array $region, $region_id);

    public function delete($region_id);

    public function getAll();
}