<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCommentedNotification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comment = Comment::where('post_id', $post->id)->paginate(1)->toJson();
        return response()->json($comment);
    }


    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($this->makeDataFromRequest($request));

        // notifications
        $admins = User::where("is_admin", 1)->get();

        // get the commented post
        $commented_post = Post::find($request->input("post_id"));
        
        $post_owner = User::find( $commented_post->user_id);

        foreach ($admins as $admin){
            $admin->notify(new PostCommentedNotification($comment));
        }

        $post_owner->notify(new PostCommentedNotification($comment));

    }

    public function destory(Comment $comment)
    {
        $this->authorize('canManage', $comment);
        $comment->delete();
    }

    public function update(Comment $comment, StoreCommentRequest $request)
    {
        $this->authorize('canManage', $comment);
        $comment->update($this->makeDataFromRequest($request));
    }

    private function makeDataFromRequest($request)
    {
        return [
            'user_id' => auth()->user()->id,
            'post_id' => $request->input('post_id'),
            'body'    => $request->input('body'),
        ];
    }

}
