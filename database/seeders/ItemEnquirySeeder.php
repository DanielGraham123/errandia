<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ItemEnquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $items;

    private $users;

    public function __construct()
    {
        $this->items = Product::all()->pluck('id');
        $this->users = User::all()->pluck('id');
    }

    public function run(Faker  $faker)
    {
        for ($i = 0; $i < 50; $i++){
            Enquiry::create([
                'item_id'     => $faker->randomElement($this->items),
                'buyer_id'    => $faker->randomElement($this->users),
                'title'       => $faker->sentence,
                'description' => $faker->sentence
            ]);
        }
    }
}
