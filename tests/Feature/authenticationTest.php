<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class authenticationTest extends TestCase
{

    use RefreshDatabase;

  /** @test */
  public function login_form_can_be_rendered()
  {
      $response = $this->get(route('login'));
      $response->assertOk()
               ->assertViewIs('auth.login');
  }

  /** @test */
  public function register_form_can_be_rendered()
  {

    $response = $this->get(route('register'));

    $response->assertOk()
             ->assertViewIs('auth.register');
  }


  /** @test */
  public function a_user_can_register_and_get_redirected_to_dashboard()
  {

    // $this->withoutExceptionHandling();

    $response = $this->post(route('register'), $this->createUser());


    $this->assertEquals(1, User::all()->count());
    
    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated($guard = null);
    
  }

  /** @test */
  public function a_user_can_login_and_get_redirected_to_dashboard()
  {

    $this->withoutExceptionHandling();
    $this->post(route('register'), $this->createUser());
    
    $response = $this->post(route('logout'));
    
    $this->assertGuest();
    $response->assertRedirect('/');


    $response = $this->post(route('login'), ['email'=> 'email@email.com', 'password' => 'password']);
    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated($guard = null);
    
  }


  /** @test */
  public function a_user_can_logout()
  {
    $this->post(route('register'), $this->createUser());
    $response = $this->post(route('logout'));

    $this->assertGuest();
    $response->assertRedirect('/');
  }

  private function createUser()
  {
    return  [
      'email' => 'email@email.com',
      'name'  => 'name',
      'password' => 'password', 
      'password_confirmation' => 'password',
    ];
  }

}
