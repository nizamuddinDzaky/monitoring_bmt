<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::truncate();
        $data = [
            [
                'roles'=> 'Admin',    
            ],
            [
                'roles'=> 'User',
            ],
        ];
        DB::table('roles')->insert($data);
    }
}
