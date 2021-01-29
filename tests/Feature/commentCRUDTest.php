<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

class commentCRUDTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        $post = Post::factory(['img' => 'noImage.jpeg'])->createOne();

        $user = User::factory()->createOne();
        $this->actingAs($user);
        $this->withoutExceptionHandling();

    }

   /** @test */
   public function a_comment_can_be_added_to_database()
   {

        $this->assertAuthenticated();
        $comment = Comment::factory(['user_id' => 1, 'post_id' => 1])->makeOne()->attributesToArray();

        $this->post(route('comment.store'), $comment);

        $this->assertCount(1, Comment::all());
      
   }

   /** @test */
   public function a_comment_can_be_deleted()
   {
        Comment::factory(['user_id' => 1, 'post_id' => 1])->createOne();
        $this->delete(route('comment.destory', 1));

        $this->assertCount(0, Comment::all());
   }

   /** @test */
   public function a_comment_can_be_updated()
   {
       $comment = Comment::factory(['user_id' => 1, 'post_id' => 1])->createOne()->attributesToArray();
       $updated_comment = [
           'body' => 'updated body',
           'user_id' => $comment['user_id'],
           'post_id' => $comment['post_id'],
       ];

       $this->put(route('comment.update', 1), $updated_comment);
       $this->assertEquals(Comment::first()->only(['body', 'user_id', 'post_id']), $updated_comment);
   }
}
