<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;

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
    public function store(PostFormRequest $PostFormRequest)
    {
        Post::create($PostFormRequest->all());
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
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\PostFormRequest  $PostFormRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $PostFormRequest, Post $post)
    {
        $post->update($PostFormRequest->all());
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
        $post->delete();
        return redirect(back());
    }
}
