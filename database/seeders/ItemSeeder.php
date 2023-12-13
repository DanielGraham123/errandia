<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class ItemSeeder extends Seeder
{
    private $shops;

    public function __construct()
    {
        $this->shops = Shop::all()->pluck('id');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $generator)
    {
        for ($counter = 0; $counter <= 100; $counter++) {
            Product::create([
                'shop_id' => $generator->randomElement($this->shops),
                'description' => $generator->sentence,
                'featured_image' => '',
                'quantity' => $generator->randomElement([20, 40, 50, 69, 70, 100]),
                'slug' => $generator->randomNumber(),
                'name' => $generator->name,
                'service' => $generator->randomElement([true, false]),
                'search_index' => '',
                'status' => $generator->randomElement([true, false]),
                'unit_price' => $generator->randomElement([1500, 4000, 5000, 2000, 6000, 10000]),
                'views' => $generator->randomNumber()
            ]);
        }
    }
}
