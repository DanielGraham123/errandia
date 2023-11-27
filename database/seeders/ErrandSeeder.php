<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Errand;
use App\Models\Region;
use App\Models\Street;
use App\Models\SubCategory;
use App\Models\Town;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ErrandSeeder extends Seeder
{
    private $users;
    private $subCategories;

    private $regions;

    private $towns;

    private $streets;

    public function __construct()
    {
        $this->users = User::all()->pluck('id');
        $this->subCategories = SubCategory::all()->pluck('id');
        $this->regions = Region::all()->pluck('id');
        $this->towns = Town::all()->pluck('id');
        $this->streets = Street::all()->pluck('id');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
         for($counter = 0; $counter < 100; $counter++) {
                Errand::create([
                    'user_id'       => $faker->randomElement($this->users),
                    'title'         => $faker->name,
                    'description'   => $faker->sentence,
                    'slug'          => $faker->randomNumber(),
                    'read_status'   => true,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                    'sub_categories' => $this->getCategoryId($faker),
                    'region_id'     => $faker->randomElement($this->regions),
                    'town_id'       => $faker->randomElement($this->towns),
                    'street_id'     => $faker->randomElement($this->streets)
                ]);
         }
    }

    private function getCategoryId(Faker $faker) {
        $category = "";
        for ($i = 0; $i < 4; $i++) {
            $category .= $faker->randomElement($this->subCategories)."-";
        }
        return $category;
    }
}
