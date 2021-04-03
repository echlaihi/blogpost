<?php

namespace Tests\Feature\authorizations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentAuthorizationTest extends TestCase
{
    
    use RefreshDatabase;
    /** @test */
    public function a_user_cannot_edit_update_delete_a_comment_does_not_belongs_to_him()
    {

        Post::factory(['img' => 'noImage.jpeg'])->createOne();
        // create a comment
        $comment = Comment::factory(['user_id' => 2, 'post_id' => 1])->createOne()->attributesToArray();
        
        
        // authenticate a user
        $user1 = User::factory()->createOne();
        $user2 = User::factory()->createOne();

        $response = $this->actingAs($user1);
        $response = $response->json('PUT', route('comment.update', 1), $comment);
        $response->assertForbidden();

        $response = $this->json('DELETE', route('comment.destory', 1));
        $response->assertForbidden();
    }
}
