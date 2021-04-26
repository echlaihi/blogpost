<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PostCreatedNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\PostFormRequest  $PostFormRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $postFormRequest)
    {
        

        if ($postFormRequest->file('img')){

            $file = $postFormRequest->file('img');
            Storage::put('public',$file);

            $img = $postFormRequest->file('img')->hashName();
        }

        $post = Post::create($this->makeDataFromRequest($postFormRequest));

        // notify the admin
        $admins = User::where("is_admin", 1)->get();
        foreach ( $admins as $admin ){
            $admin->notify(new PostCreatedNotification($post));
        } 

    }

    /**
     * Display the specified post.
     *
     * @param  \App\Models\Post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  \App\Models\Post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('manage', $post);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\PostFormRequest  $postFormRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $postFormRequest, Post $post)
    {
        $this->authorize('manage', $post);
        $post->update($this->makeDataFromRequest($postFormRequest));
        return redirect(back());
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('manage', $post);
        $post->delete();
        return redirect(back());
    }

    /** 
     * Return data based on the request
     *  @param App\Http\Request\PostFormRequest
     *  @return array
     */
    private function makeDataFromRequest(PostFormRequest $postFormRequest)
    {
        return [
            'title'   => $postFormRequest->input('title'),
            'body'    => $postFormRequest->input('body'),
            'user_id' => auth()->user()->id,
            'img'     => $postFormRequest->hasFile('img') ? $postFormRequest->file('img')->hashName() : 'noImage.jpeg',
        ];
    }
}
