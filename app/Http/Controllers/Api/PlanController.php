<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        return $this->build_success_response(response(), 'plans loaded', [
            'items' => Plan::orderBy('id')->get()
        ]);
    }
}