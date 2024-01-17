<?php

use Database\Seeders\BatchSeeder;
use Database\Seeders\SchoolUnitSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\RolesPermissionSeeder;
use Database\Seeders\UserRoleSeeder;
use Database\Seeders\UserPermissionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(PermissionSeeder::class);
//        $this->call(RolesSeeder::class);
//        $this->call(RolesPermissionSeeder::class);
//        $this->call(UserRoleSeeder::class);
//        $this->call(UserPermissionSeeder::class);
//        $this->call(\Database\Seeders\ItemSeeder::class);
//        $this->call(\Database\Seeders\ErrandSeeder::class);
//        $this->call(\Database\Seeders\ItemEnquirySeeder::class);
//        $this->call(\Database\Seeders\CurrencySeeder::class);
    }
}
