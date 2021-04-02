<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::paginate(1)->toJson();
        return response()->json($comment);
    }
    public function store(Request $request)
    {
        Comment::create($this->makeDataFromRequest($request));
    }

    public function destory(Comment $comment)
    {
        $this->authorize('canManage', $comment);
        $comment->delete();
    }

    public function update(Comment $comment, Request $request)
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
