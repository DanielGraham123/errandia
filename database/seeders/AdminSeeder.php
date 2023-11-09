<?php


use App\Models\Admin;
use App\Models\User;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::create([
            'name' => 'Admin',
            'email' => 'admin',
            'phone' => '237983432334',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'active'=>1
        ]);
    }
}
