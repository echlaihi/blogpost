<?php

namespace Tests\Feature\authorizations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\User;

class CommentAuthorizationTest extends TestCase
{
    
    use RefreshDatabase;
    /** @test */
    public function a_user_cannot_edit_update_delete_a_comment_does_not_belongs_to_him()
    {
        // create a comment
        $comment = Comment::factory(['user_id' => 2])->createOne()->attributesToArray();

        // authenticate a user
        $user = User::factory()->createOne();
        $response = $this->actingAs($user);
        $response = $response->json('PUT', route('comment.update', 1), $comment);
        $response->assertForbidden();

        $response = $this->json('DELETE', route('comment.destory', 1));
        $response->assertForbidden();
    }
}
