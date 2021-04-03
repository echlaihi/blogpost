<?php

namespace Tests\Feature\validations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

class CommentValidationTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   public function a_body_must_be_less_than_500_char_and_not_empty()
   {
      $comment = array(
         "body" => "this is ",
         "post_id" => 1,
      );

      $post = Post::factory(['img' => 'noImage.jpeg'])->createOne();

      $user = User::factory()->createOne();
      $response = $this->actingAs($user);
      $response = $response->json("POST", route("comment.store", 1), $comment);
      $response->assertStatus(422);
      // $response->assertJsonStructure([
      //    "errors" => true,
      //    "error_message" => "invalid inputs",
      // ]);
   }
  
   
}
