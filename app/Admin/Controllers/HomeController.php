<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Errand;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;
use OpenAdmin\Admin\Widgets\Box;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->css_file(Admin::asset("open-admin/css/pages/dashboard.css"))
            ->header('Dashboard')
//            ->title('Dashboard')
//            ->description('Welcome to the administration dashboard for Errandia');
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append("Welcome to the administration dashboard for Errandia");
                });

                // boxes for the dashboard with number of users, shops, orders, etc.
                $row->column(3, function (Column $column){
                    $column->append(
                        (new Box('', User::count(), 'Users'))->styles([
                            'background' => 'blue',
                            'color' => 'white',
                            'margin-top'=>'25px',
                            'font-weight'=>'500',
                            'border-radius' => '5px',
                            'font-size' => '20px',
                            'box-shadow' => '0 0 10px rgba(0, 0, 0, 0.1)'
                        ])
                    );
                });

                $row->column(3, function (Column $column){
                    $column->append(
                        (new Box('', Shop::count(), 'Shops'))->styles([
                            'background' => 'green',
                            'color' => 'white',
                            'margin-top'=>'25px',
                            'font-weight'=>'500',
                            'border-radius' => '5px',
                            'font-size' => '20px',
                            'box-shadow' => '0 0 10px rgba(0, 0, 0, 0.1)'
                        ])
                    );
                });

                $row->column(3, function (Column $column){
                    $column->append(
                        (new Box('', Errand::count(), 'Errands'))->styles([
                            'background' => 'red',
                            'color' => 'white',
                            'margin-top'=>'25px',
                            'font-weight'=>'500',
                            'border-radius' => '5px',
                            'font-size' => '20px',
                            'box-shadow' => '0 0 10px rgba(0, 0, 0, 0.1)'
                        ]));
                });

                $row->column(3, function (Column $column){
                    $column->append(
                        (new Box('', Product::count(), 'Products/Services'))->styles([
                            'background' => 'purple',
                            'color' => 'white',
                            'margin-top'=>'25px',
                            'font-weight'=>'500',
                            'border-radius' => '5px',
                            'font-size' => '20px',
                            'box-shadow' => '0 0 10px rgba(0, 0, 0, 0.1)'
                        ]));
                });
            })
            ->body(view('admin.charts.bar'));
//            ->row(function (Row $row) {

//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::environment());
//                });
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::extensions());
//                });
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::dependencies());
//                });
//            });
    }
}
