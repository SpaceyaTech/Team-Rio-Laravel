<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1, 'role_name' => 'Admin',],
            ['id' => 2, 'role_name' => 'Simple user',],
           
        ];

        foreach ($items as $item) {
            Role::create($item);
        }
    
    }
}
