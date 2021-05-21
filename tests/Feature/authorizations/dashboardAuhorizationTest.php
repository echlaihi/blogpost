<?php

namespace Tests\Feature\authorizations;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class dashboardAuhorizationTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function non_admin_users_cannot_access_the_admin_area()
    {
        $this->withoutExceptionHandling();
        $user = User::factory(['is_admin' => 0])->createOne();
        $response = $this->actingAs($user);
        $response = $response->get(route('admin.dashboard'));
        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function admin_user_can_login_as_regular_user()
    {
        $user = User::factory(['is_admin' => 1])->createOne();
        $response = $this->actingAs($user);
        $response = $response->get(route('dashboard'));
        $response->assertOk();
        $response->assertViewIs('auth.dashboard');
    }
}
