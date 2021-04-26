<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Support\Facades\Notification;

class notificationTest extends TestCase
{
    use RefreshDatabase;
    

    /** @test */
    public function notify_admin_when_new_user_has_registered()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin' => 1, "email" => "admin@email.com"])->createOne();

        $user = [
            "name" => "user name", 
            "email" => "user@email.com",
            "password" => "password", 
            "password_confirmation" => "password",
        ];

        $response = $this->post(route('register'), $user);
        $this->assertCount(1, $admin->notifications);


    }

    /** @test */
    public function notify_admin_when_new_post_has_created()
    {

        $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin' => 1])->create();

        $post = Post::factory()->makeOne()->attributesToArray();

        $response = $this->actingAs($admin);
        $response->post(route('post.store'), $post);
        $this->assertCount(1, $admin->notifications);
    }

    /** @test */
    public function notify_the_owner_of_the_post_and_admin_when_a_post_commented()
    {

        $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin'=> 1])->create();
        $post_owner = User::factory()->create();

        $post = Post::factory(['user_id' => 2, 'img' => 'noImage.jpeg'])->createOne();
        $comment = array(
            "body" => "this is the comment body",
            "post_id" => 1,
        );

        $response = $this->actingAs($post_owner);
        $response->post(route('comment.store'), $comment);
        

        $this->assertCount(1, $post_owner->notifications);
        $this->assertCount(1, $admin->notifications);
    }

}
