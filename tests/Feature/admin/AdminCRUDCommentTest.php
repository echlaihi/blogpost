<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCRUDCommentTest extends TestCase
{   
    
    use RefreshDatabase;


    /** @test */
    public function admin_can_update_any_comment()
    {
        User::factory()->createOne();

        $post = Post::factory(['img' => 'noImage', 'user_id' => 2])->createOne();
        $comment = Comment::factory(['post_id' => 1, 'user_id' => 2])->createOne()->only(['body', 'post_id']);
        $comment['body'] = 'this is the updated comment body';
        $admin = User::factory()->createOne();

        $response = $this->actingAs($admin);
      
        $reponse = $response->put(route('comment.update', 1), $comment);
        $this->assertSame($comment['body'], Comment::first()->only(['body'])['body']);
        $reponse->assertOk();

    }

    public function admin_can_delete_any_comment()
    {

        User::factory()->createOne();

        $post = Post::factory(['img' => 'noImage', 'user_id' => 2])->createOne();
        $comment = Comment::factory(['post_id' => 1, 'user_id' => 2])->createOne()->only(['body', 'post_id']);
        $comment['body'] = 'this is the updated comment body';
        $admin = User::factory()->createOne();

        $response = $this->actingAs($admin);

        $response = $response->delete(route('comment.destory', 1));

    }
}
