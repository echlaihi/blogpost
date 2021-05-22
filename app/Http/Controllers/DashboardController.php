<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin){

            // return user profile
            $posts = Post::where('user_id', auth()->user()->id)->paginate();
            return view('auth.dashboard')->with('posts', $posts);
        }

        // return admin panel
        $num_users = User::all()->count();
        $num_posts = Post::all()->count();
        $num_comments = Comment::all()->count();
        $num_notifications = User::find(auth()->user()->id)->notifications()->count();

        return view('admin.dashboard')->with([
            'num_user' => $num_users,
            'num_comments' => $num_comments,
            'num_posts' => $num_posts,
            'num_notifications'=> $num_notifications, 
        ]);


    }

    // this function to list all the notifications
    public function listNotifications()
    {
        $notifications = User::find(auth()->user()->id)->notifications();
        return view('auth.notifications')->with('notifications', $notifications);
    }

    // this function to make a certain notification as read
    public function readNotification($id)
    {
        $notification = DatabaseNotification::find($id);


        if (!$notification or auth()->user()->id != $notification->notifiable_id) {
            return abort(404);
        }

        $notification->markAsRead();
        return back();
    }

}
