<?php

namespace Tests\Feature\authorizations;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostAuthorizationTest extends TestCase
{
    use RefreshDatabase;

   
    /** @test */
    public function guest_user_cannot_crud_the_post()
    {
        $post = Post::factory()->makeOne()->attributesToArray();

        $response = array();

        $response[0] = $this->get(route('post.create'));
        $response[1] = $this->get(route('post.edit', 1));
        $response[2] = $this->post(route('post.store'), $post);
        $response[3] = $this->put(route('post.update', 1), $post);
        $response[4] = $this->delete(route('post.destory', 1));

        for($i=0; $i < 5; $i++){
            $response[$i]->assertRedirect(route('login'));
        }
        
    }

    /** @test */
    public function regular_user_cannot_edit_update_delete_does_not_belongs_to_him()
    {

        $users = User::factory(2)->create();
        $post1 = Post::factory()->create(['user_id' => 1, 'img' => 'noImage.jpg']);
        $post2 = Post::factory()->create(['user_id' => 2, 'img' => 'noImage.jpg']);

        $this->assertCount(2, Post::all());
        $this->assertCount(2, User::all());

        
        $updated_post = Post::factory()->make()->attributesToArray();

        $authUser = $this->actingAs(User::first());
        $authUser->assertAuthenticated();

        $responses = array();

        $responses[0] = $authUser->get(route('post.edit', 2));
        $responses[1] = $authUser->put(route('post.update', 2), $updated_post);
        $responses[2] = $authUser->delete(route('post.destory', 2));

        foreach($responses as $response){
            $response->assertForbidden();
        }

    }

  
}
