<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'DAILY',
                'description' => 'Daily Plan',
                'unit_price' => 50,
            ],
            [
                'name' => 'MONTHLY',
                'description' => 'Monthly Plan',
                'unit_price' => 500,
            ],
            [
                'name' => 'YEARLY',
                'description' => 'Yearly Plan',
                'unit_price' => 5000,
            ]
        ];
        foreach ($plans as $plan) {
            if (!Plan::where('name', $plan['name'])->first()){
                Plan::create($plan);
            }
        }
    }
}
