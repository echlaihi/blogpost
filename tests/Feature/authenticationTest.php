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
  public function when_admin_login_redirect_him_to_admin_dashboard()
  {
    $user = [
      'email' => 'root@email.com', 
      'name' => 'name', 
      'password' => 'password', 
      'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register', $user));
    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard'));

  }

  /** @test */
  public function regualar_user_get_redirected_to_their_profile()
  {

    $user = User::factory(['is_admin' => 0])->create()->only(['email']);
    $user['password'] = 'password';

    $response = $this->post(route('login'), $user);
    $this->assertAuthenticated();

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
