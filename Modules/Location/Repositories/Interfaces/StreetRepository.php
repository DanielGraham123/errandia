<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:38 PM
 */

namespace Modules\Location\Repositories\Interfaces;

interface StreetRepository
{
    public function create(array $street);

    public function findById($street_id);

    public function update(array $street, $street_id);

    public function delete($street_id);

    public function getAll();
	public function getStreetByTown($town_id);
}
?>