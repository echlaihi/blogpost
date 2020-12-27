<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostCrudTest extends TestCase
{

     use RefreshDatabase;

     protected function setUp(): void
     {
          parent::setUp();
          $this->withoutExceptionHandling();


          $response = $this->post(route('register'), [
               'email' => 'email@email.com',
               'name'  => 'name',
               'password' => 'password',
               'password_confirmation' => 'password',
          ]);
     }



     /** @test */
     public function a_create_post_form_can_be_rendered()
     {

          $response = $this->get(route('post.create'));

          $response->assertOk();
          $response->assertViewIs('posts.create');
     }

     /** @test  */
     public function a_post_can_be_stored_in_database()
     {

          // create a fake image
          $img = UploadedFile::fake()->image('img.jpg', 1000, 500)->size(1000);
          $post = Post::factory(['img' => $img])->makeOne()->attributesToArray();

          $response = $this->post(route('post.store'), $post);

          $response->assertSuccessful();
          $this->assertEquals(1, Post::all()->count());
          Storage::disk('public')->assertExists($img->hashName());
          $this->assertEquals(Post::first()->img, $img->hashName());
     }


     /** @test */
     public function a_post_can_be_rendered()
     {
          $this->StorePostInDatabase();

          // get the post
          $response = $this->get(route('post.show', 1));

          $response->assertOk();
          $response->assertViewIs('posts.show');
     }

     /** @test */
     public function all_the_post_can_be_rendered()
     {
          $posts = Post::factory(10)->make();

          foreach ($posts as $post) {

               $post = $post->attributesToArray();
               $this->post(route('post.store'), $post);
          };

          $response = $this->get(route('post.index'));

          $response->assertOk();
          $response->assertViewIs('posts.index');
     }

     /** @test */
     public function edit_post_from_can_be_rendered()
     {
          $this->StorePostInDatabase();

          $response = $this->get(route('post.edit', 1));

          $response->assertOk();
          $response->assertViewIs('posts.edit');
     }

     /** @test */
     public function a_post_can_be_updated()
     {
          $this->StorePostInDatabase();

          $updated_post = Post::factory()->makeOne()->toArray();

          $response = $this->put(route('post.update', 1), $updated_post);

          $updated_post['img'] = 'noImage.jpeg';

          $actual_post = array_slice(Post::first()->toArray(), 1, 4);

          $response->assertRedirect(back());
          $this->assertTrue($updated_post == $actual_post);
     }

     /** @test */
     public function a_post_can_be_destroyed()
     {

         $this->StorePostInDatabase();

          $response = $this->delete(route('post.destory', 1));

          $response->assertRedirect(back());
          $this->assertCount(0, Post::all());
     }

     private function StorePostInDatabase()
     {
          $post = Post::factory()->makeOne()->attributesToArray();
          $this->post(route('post.store'), $post);
     }
}
