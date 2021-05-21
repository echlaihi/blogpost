<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class adminCRUDUsersTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function admin_can_update_user()
    {

        $this->withoutExceptionHandling();

        User::factory()->createOne();
        $admin = User::factory(['is_admin' => 1])->createOne();
        $updated_user1 = [
            'name' => 'name',
            'email' => 'email@email.com',
            'is_admin' => 1,
        ];

        $updated_user2 = [
            'name' => 'name',
            'email' => 'email@email.com',
            'is_admin' => 0,
        ];

        $response1 = $this->actingAs($admin);
        $response = $response1->post(route('user.update', 1), $updated_user1);
        $response->assertOk();
        $this->assertSame(1, (int) User::first()->is_admin);
        
        $response = $response1->post(route('user.update', 1), $updated_user2);
        $response->assertOk();
        $this->assertSame(0, (int) User::first()->is_admin);

    }

    /** @test */
    public function non_admin_users_cannot_update_user_privleges()
    {
        $user1 = User::factory(['is_admin' => 0])->createOne()->only(['name', 'email', 'is_admin']);
        $user2 = User::factory(['is_admin' => 0])->createOne();

        $updated_user1 = [
            'email' => 'email@email.com',
            'name'  => 'updated name', 
            'is_admin' => 1,

        ];

        $response = $this->actingAs($user2);
        $response = $response->post(route('user.update', 1), $updated_user1);
        $response->assertForbidden();
        
    }

}