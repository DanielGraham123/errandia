<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{

    public function __construct(){}

    public function save($data)
    {
        return Payment::create($data);
    }

    public function update()
    {

    }

}