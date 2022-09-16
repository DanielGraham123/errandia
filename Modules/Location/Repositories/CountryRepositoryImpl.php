<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 12/7/2020
 * Time: 8:41 PM
 */

namespace Modules\Location\Repositories;


use Illuminate\Database\Eloquent\Model;
use Modules\BaseRepository;
use Modules\Location\Entities\Country;
use Modules\Location\Repositories\Interfaces\CountryRepository;

class CountryRepositoryImpl extends BaseRepository implements CountryRepository
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    public function create(array $country)
    {
        return $this->model->create($country);
    }

    public function findById($country_id)
    {
        return $this->model->find($country_id);
    }

    public function update(array $country, $country_id)
    {
        return $this->model->find($country_id)->update($country);
    }

    public function delete($country_id)
    {
        return $this->model->find($country_id)->delete();
    }

    public function getAll()
    {
        return $this->model->get();
    }

}