<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AdminCRUDPostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setup();

        $user = User::factory(['is_admin' => 1])->createOne();
        $response = $this->actingAs($user);

    }

    /** @test */
    public function dashboard_panel_can_be_rendered()
    {

        $response = $this->get(route('dashboard'));
        $response->assertOk();
        $response->assertViewIs('admin.dashboard');
    }

    /** @test */
    public function admin_can_delete_any_post()
    {
        $this->withExceptionHandling();
        Post::factory(['user_id' => 2, 'img' => 'noImage.jpeg'])->createOne();

        $userAdmin  = User::factory(['is_admin' => 1])->createOne();

        $response = $this->actingAs($userAdmin);
        $response = $response->delete(route('post.destory', 1));
        $response->assertRedirect();
    }

    /** @test */
    public function admin_can_update_any_post()
    {
        $post = Post::factory(['user_id' => 2, 'img' => 'noImage.jpeg'])->createOne()->attributesToArray();

        $post['body'] = 'this is the updated body post';

        $admin = User::factory(['is_admin' => 1])->createOne();
        $response = $this->actingAs($admin);

        $response = $response->put(route('post.update', 1), $post);
        $response->assertRedirect();

    }

    /** @test
     */
    public function admin_can_list_all_posts()
    {
        $response = $this->get(route("dashboard.posts"));
        $response->assertOk();
    }

  

}
