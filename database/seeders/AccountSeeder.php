<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Account::create([
            "user_id" => 1,
            "account_name" =>"Victor",
            "image" => "photo url",
            "bio_data" =>"my testing bio data for the account",

        ]);
        Account::factory()->count(20)->create();
    }
}
