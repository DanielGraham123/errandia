<?php
/**
 * AUthor: Dieudonne Takougang
 * Date: 11/10/2020
 * Base repository class to support model initialization
 */

namespace Modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->updateCurrncy();
    }

    public function updateCurrncy(){
        $currency = DB::table('currencies')->where('name','=','CAF')->first();
        if ($currency){
            DB::table('currencies')
                ->where('id',$currency->id)
                ->update(['name'=>'XAF']);
        }
    }
}
