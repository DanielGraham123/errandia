<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Resources\Fee;
use App\Http\Resources\CollectBoardingFeeResource;
use App\Models\Batch;
use App\Models\Rank;
use App\Models\SchoolUnits;
use App\Models\Sequence;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Campus;
use App\Models\Color;
use App\Models\PaymentItem;
use App\Models\Payments;
use App\Models\ProgramLevel;
use Illuminate\Support\Facades\Auth;
use Throwable;
use \PDF;

class HomeController extends Controller
{

    private $select = [
    ];
    private $select1 = [];
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->to(route('login'));
    }

}
