<?php

namespace Tests\Unit\validations;

use App\Http\Requests\PostFormRequest;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class PostFormRequestTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        
        // bind the PostFormRequest
        $this->postFormRequest = new PostFormRequest();

    }

    /** @test */
   public function test_rules()
   {

       $rules = [
           'title'   => 'required|string|max:255',
           'body'    => 'required|string|max:1000',
           'user_id' => 'exists:App\Models\User,id',
        //    'img'     => 'mimes:jpeg,png|min:1500|nullable',
       ];

       $this->assertEquals($rules, $this->postFormRequest->rules());

   }

   /** @test */
   public function test_authorize()
   {
       $this->assertTrue($this->postFormRequest->authorize());
   }

}
