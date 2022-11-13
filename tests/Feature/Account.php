<?php

namespace Tests\Feature;

use App\Models\Account as ModelsAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class Account extends TestCase
{  
    
    use RefreshDatabase;

    public function setUP():void
    {
        parent::setUP();
        Artisan::call('passport:install');

    }


    public function test_required_fields_for_account(){

        $this->withoutExceptionHandling();
        $response = $this->post('/api/account/register',[
            "user_id" => 1,
            "name" =>  's_test',
            "image" => "image url",
            "emphil" => 'test@test.com',
            "about" => 'bio data',
       
        ]);
        $response->assertOk();
        $this->assertCount(1,ModelsAccount::all());
    }

}
