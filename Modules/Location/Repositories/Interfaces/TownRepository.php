<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:38 PM
 */

namespace Modules\Location\Repositories\Interfaces;

interface TownRepository
{
    public function create(array $town);

    public function findById($town_id);

    public function update(array $town, $town_id);

    public function delete($town_id);

    public function getAll();
	public function getTownByRegion($region_id);
}