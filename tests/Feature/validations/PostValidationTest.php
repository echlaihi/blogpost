<?php

namespace Tests\Feature\validations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostValidationTest extends TestCase
{
    /** @test */
    public function post_id_in_request_must_be_integer()
    {

        $post = Post::factory()->makeOne()->attributesToArray();
        $this->post(route('post.store'), $post);

        $response = $this->get(route('post.show', 'k'));
        $response->assertStatus(404);

    }

}
