<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Notifications\DatabaseNotification;

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

    // public function notify_the_owner_of_the_post_and_admin_when_a_post_commented()
    // {

    //     $this->withoutExceptionHandling();
    //     $admin = User::factory(['is_admin'=> 1])->create();
    //     $post_owner = User::factory()->create();

    //     $post = Post::factory(['user_id' => 2, 'img' => 'noImage.jpeg'])->createOne();
    //     $comment = array(
    //         "body"    => "this is the comment body",
    //         "post_id" => 1,
    //     );

    //     $response = $this->actingAs($post_owner);
    //     $response->post(route('comment.store'), $comment);
        

    //     $this->assertCount(1, $post_owner->notifications);
    //     $this->assertCount(1, $admin->notifications);
    // }


    /** @test */
    public function a_user_can_list_all_of_his_notifications()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->createOne();
        $response = $this->actingAs($user);
        $response = $response->get(route('notifications.list'));
        $response->assertOk();
        // $response->dump();
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory(['is_admin' => 1])->createOne();
        $response = $this->actingAs($admin);
        $response = $this->post(route('post.store', Post::factory(['img' => 'noImage.jpeg'])->makeOne()->attributesToArray()));
        $notf_id = DatabaseNotification::first()->id;
       
        $response = $this->get(route('notification.read', $notf_id));
        $this->assertNotNull(DatabaseNotification::find($notf_id)->read_at);

    }

    /** @test */
    public function a_user_cannot_mark_a_notification_does_not_belongs_to_him()
    {

        $admin = User::factory(['is_admin' => 1])->createOne();
        $response = $this->actingAs($admin);
        $response = $this->post(route('post.store', Post::factory(['img' => 'noImage.jpeg'])->makeOne()->attributesToArray()));
        $notf_id = DatabaseNotification::first()->id;

        
        $new_user = User::factory()->createOne();
        $response = $this->actingAs($new_user);
        $response = $this->get(route('notification.read', $notf_id));
        $response->assertNotFound();

    }

    /** @test */
    public function the_notification_to_mark_as_read_must_exist()
    {
        $admin = User::factory(['is_admin' => 1])->createOne();
        $response = $this->actingAs($admin);
        $response = $this->post(route('post.store', Post::factory(['img' => 'noImage.jpeg'])->makeOne()->attributesToArray()));
        $notf_id = 'id';
       
        $response = $this->get(route('notification.read', $notf_id));
        $response->assertNotFound();
    }

}
