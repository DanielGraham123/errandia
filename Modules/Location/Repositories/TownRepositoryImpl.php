<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:53 PM
 */

namespace Modules\Location\Repositories;

use Modules\BaseRepository;
use Modules\Location\Entities\Town;
use Modules\Location\Repositories\Interfaces\TownRepository;

class TownRepositoryImpl extends BaseRepository implements TownRepository
{
    public function __construct(Town $model)
    {
        parent::__construct($model);
    }

    public function create(array $town)
    {
        return $this->model->create($town);
    }

    public function findById($town_id)
    {
        return $this->model->where('id', $town_id)->with('region.country')->first();
    }

    public function update(array $town, $town_id)
    {
        return $this->model->find($town_id)->update($town);
    }

    public function delete($town_id)
    {
        return $this->model->find($town_id)->delete();
    }

    public function getAll()
    {
        return $this->model->get();
    }
	
	public function getTownByRegion($region_id)
    {
		//return  $this->model->orderBy('name','asc')->all()->where('region_id', $region_id); 
		return $this->model->orderBy('name','asc')->where('region_id', $region_id)->get();
    }
}
