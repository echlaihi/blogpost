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
    public function admin_can_access_to_admin_panel()
    {
        $this->withoutExceptionHandling();
        $user = User::factory(['is_admin' => 1])->createOne();
        $response = $this->actingAs($user);
        $response = $response->get(route('dashboard'));
        $response->assertOk();
        $response->assertViewIs('admin.dashboard');

    }

    /**  @test */
    public function regular_users_can_access_to_their_profile()
    {
        $user = User::factory(['is_admin' => 0])->createOne();
        $response = $this->actingAs($user);
        $response = $response->get(route('dashboard'));
        $response->assertOk();
        $response->assertViewIs('auth.dashboard');
    }


}
