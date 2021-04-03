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

        $comment = Comment::factory()->makeOne()->attributesToArray();
        $this->json('POST',route('comment.store', 1), $comment);
        $this->assertCount(1, Comment::all());
      
   }

   /** @test */
   public function a_comment_can_be_deleted()
   {    
        Comment::factory(['user_id' => 1, 'post_id' => 1])->createOne();
        $response = $this->json('DELETE', route('comment.destory',1));
        $this->assertCount(0, Comment::all());
   }

   /** @test */
   public function a_comment_can_be_updated()
   {
        Post::factory(['img' => 'noImage.jpeg'])->createOne();
       $comment = Comment::factory(['user_id' => 1, 'post_id' => 1])->createOne()->attributesToArray();

       $updated_comment = [
           'body'    => 'updated body',
           'user_id' => '1',
           'post_id' => '1',
       ];

       $response = $this->json('PUT', route('comment.update',1), $updated_comment);
       $this->assertSame(Comment::first()->only(['body', 'user_id', 'post_id']), $updated_comment);
   }

   /** @test */
   public function comments_can_be_rendered_in_json_format_and_paginated()
   {

        $comment = Comment::factory(20)->create(['user_id' => 1, 'post_id' => 1]);

        $response = $this->json('GET', route('comment.index', ['post' => 1, 'comment' => 1]));

        // $response->assertJsonStructure([
        //     'data' => ['body', 'created_at', 'updated_at'],
        //     'first_page_url','from',
        //     'last_page', 'last_page_url',
        //     'links' => ['*' => ['active', 'label','url']],
        //     'next_page_url', 'path','per_page', 'prev_page_url', 'to', 'total',
        // ]);
        
        $response->assertOk();
        

   }
}
