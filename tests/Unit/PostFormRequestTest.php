<?php

namespace Tests\Unit;

use App\Http\Requests\PostFormRequest;
use PHPUnit\Framework\TestCase;

class PostFormRequestTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();

        $this->postFormRequest = new PostFormRequest();
    }

    /** @test */
    public function test_rules()
    {
        $rules = [
            'title'   => 'required|string|max:255',
            'body'    => 'required|string|max:1000',
            'img'     => 'nullable|mimes:jpeg,png,jpg|dimensions:max_with=2000,max_height=1000,min_width=700,min_height=500',
            'user_id' => 'required|integer|exists:App\Models\User,id',
        ];

        $this->assertEquals($rules, $this->postFormRequest->rules());
    }

    /** @test */
    public function test_authorize()
    {
        $this->assertTrue($this->postFormRequest->authorize());
    }
}
