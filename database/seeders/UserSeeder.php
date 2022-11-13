<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'space',
            'second_name' => 'ya tech',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'phone_no' => '0700000000',
            // 'verification_code',1111,
            // 'number_of_verification_request'=>1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

        ]);

    
       
       User::factory()->count(10)->create(); 
}
}
