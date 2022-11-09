<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Auth\RequestGuard;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUP():void
    {
        parent::setUP();
        Artisan::call('passport:install');

    }

    public function test_required_fields_for_registration(){

        $this->withoutExceptionHandling();
        $response = $this->post('/api/register',[
            "first_name" => 'f_test',
            "second_name" =>  's_test',
            "username" => "f_test"."_"."s_test",
            "email" => 'test@test.com',
            "phone_no" => '0726262626',
            "image" => 'image ura',
            "gender" => 'male',
            "status" => 'active',
            "about" => "The status field is required.",
            "password" => 'password',
            "password_confirmation" => 'password'
        ]);
        $response->assertOk();
        $this->assertCount(1,User::all());
    }

    public function test_password_must_be_same(){

    
        $response = $this->post('/api/register',[
            "first_name" => 'f_test',
            "second_name" =>  's_test',
            "username" => "f_test"."_"."s_test",
            "email" => 'test@test.com',
            "phone_no" => '0726262626',
            "image" => 'image ura',
            "gender" => 'male',
            "status" => 'active',
            "about" => "The status field is required.",
            "password" => 'password',
            "password_confirmation" => 'password2'
        ]);
        $response->assertSessionHasErrors('password');
        
        $response->assertStatus(302);
    }

    public function test_email_and_password_is_required_to_login(){


        $this->withoutExceptionHandling();

      $response =  $this->post('api/login',
    [
        'email'=>'test@test.com',
        'password'=>'password'
    ]);
    $response->assertStatus(200);
    }


   

    public function test_login_valid_user()
    {
        $user = User::factory()->create();

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);

        $this->assertAuthenticatedAs($user);

    }
    public function test_can_a_user_logout()
    {
 
    $user =User::factory()->make();
    $response = $this->actingAs($user)->get(route('logout')) 
     ->assertRedirect(route('login'))
     ->assertStatus(302);
        
        
    }

        
        
   
}
