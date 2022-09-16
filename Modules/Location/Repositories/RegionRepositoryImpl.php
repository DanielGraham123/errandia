<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:50 PM
 */

namespace Modules\Location\Repositories;

use Modules\BaseRepository;
use Modules\Location\Entities\Region;
use Modules\Location\Repositories\Interfaces\RegionRepository;

class RegionRepositoryImpl extends BaseRepository implements RegionRepository
{
    public function __construct(Region $model)
    {
        parent::__construct($model);
    }

    public function create(array $region)
    {
        return $this->model->create($region);
    }

    public function findById($region_id)
    {
        return $this->model->find($region_id);
    }

    public function update(array $region, $region_id)
    {
        return $this->model->find($region_id)->update($region);
    }

    public function delete($region_id)
    {
        return $this->model->find($region_id)->delete();
    }

    public function getAll()
    {
        return $this->model->get();
    }
}