<?php

namespace Modules\Street\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Location\Entities\Town;

class Street extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'town_id', 'status', 'townName'];

    protected static function newFactory()
    {
        return \Modules\Street\Database\factories\StreetFactory::new();
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public static function getTableName()
    {
        return "streets";
    }

    public function getAllStreets()
    {
        return Street::orderBy('name','asc')->get();
    }

    public function getAllStreet()
    {
        //return  Street::get()->all();
        $Street = Street::join('towns', 'towns.id', '=', 'streets.town_id')
            ->get(['streets.name', 'streets.id', 'towns.name as townName']);

        return $Street;
    }

    public function getAllTown()
    {
        return Street::select('*')->from('towns')->orderBy('name','asc')->get();
    }

    public function findStreetByID($id)
    {
        $Street = Street::select('*')->where('streets.id', '=', $id)->get();
        return $Street;
    }

    public function updateStreet($id, $streetDatails)
    {
        return Street::whereId($id)->update($streetDatails);
    }

    public function saveStreet($streetDatails)
    {
        return Street::create($streetDatails);
    }

    public function deleteStreet($id)
    {
        return Street::whereId($id)->delete($id);
    }

    public static function getStreetByTownId($townId)
    {
        return Street::where('town_id', $townId)->orderBy('name','asc')->get();
    }
}
