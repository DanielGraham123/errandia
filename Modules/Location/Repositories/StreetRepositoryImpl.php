<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:53 PM
 */

namespace Modules\Location\Repositories;

use Modules\BaseRepository;
use Modules\Location\Repositories\Interfaces\StreetRepository;
use Modules\Street\Entities\Street;

class StreetRepositoryImpl extends BaseRepository implements StreetRepository
{
    public function __construct(Street $model)
    {
        parent::__construct($model);
    }

    public function create(array $street)
    {
        return $this->model->create($street);
    }

    public function findById($street_id)
    {
        return $this->model->where('id', $street_id)->with('town.region.country')->first();
    }

    public function update(array $street, $street_id)
    {
        return $this->model->find($street_id)->update($street);
    }

    public function delete($street_id)
    {
        return $this->model->find($street_id)->delete();
    }

    public function getAll()
    {
        return $this->model->get();
    }

	public function getStreetByTown($town_id)
    {
        return  $this->model->orderBy('name','asc')->where('town_id', $town_id)->get();
    }
}
