<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('users')->insert([
            'name'=>"Admin",
            'email'=> 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id'=>1,
            "is_active" => 1,
        ]);
    }
}
