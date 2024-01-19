<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use \Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use phpseclib3\Exception\UnsupportedOperationException;

class ValidationService{

    public function validate($data, $rules)
    {
        # code...
        $validity = Validator::make($data, $rules);
        if($validity->fails())
        {
            throw new ValidationException($validity);
        }
        return true;
    }

}