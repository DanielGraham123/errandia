<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Errand;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ErrandSeeder extends Seeder
{
    private $users;
    private $categories;

    public function __construct()
    {
        $this->users = User::all()->pluck('id');
        $this->categories = Category::all()->pluck('id');
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
                    'user_id' => $faker->randomElement($this->users),
                    'title' => $faker->name,
                    'description' => $faker->sentence,
                    'slug' => $faker->randomNumber(),
                    'read_status' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'sub_categories' => $this->getCategoryId($faker),
                ]);
         }
    }

    private function getCategoryId(Faker $faker) {
        $category = "";
        for ($i = 0; $i < 4; $i++) {
            $category .= $faker->randomElement($this->categories)."-";
        }
        return $category;
    }
}
