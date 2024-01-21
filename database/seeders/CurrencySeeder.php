<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
//        for($i = 0; $i < 7; $i++){
//            Currency::create([
//                'name'  => $faker->currencyCode,
//            ]);
//        }

        Currency::create([
            'name' => 'XAF'
        ]);
    }
}
