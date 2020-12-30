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

    protected function setUp(): void
    {
        parent::setUp();
        $this->withExceptionHandling();
    }
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
    public function regular_user_cannot_edit_update_destory_post_which_does_not_belongs_to_him()
    {

        // store 2 user in DB
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // store 2 post in DB one has user_id = 1 other has 2
        $post = Post::factory()->create(['user_id' => 1]);
        $post2 = Post::factory()->create(['user_id' => 2]);

        $this->assertCount(2, Post::all());
        $this->assertCount(2, User::all());
      
        

        
    }

    private function createUser($type)
    {
        if ($type == 'login'){
            return [
                'email' => 'email.email.com',
                'password' => 'password',
            ];
        }

         return [
            'name' => 'name',
            'email' => 'email.email@com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];


    }
}
