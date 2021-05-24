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
        $num_notifications = User::find(auth()->user()->id)->notifications()->count();

        if (!auth()->user()->is_admin){

            // return user profile
            $posts = Post::where('user_id', auth()->user()->id)->paginate(10);
            return view('auth.dashboard')->with([
                'num_notifications' => $num_notifications,
                'posts'             => $posts,
            ]);
        }

        // return admin panel
        $num_users = User::all()->count();
        $num_posts = Post::all()->count();
        $num_comments = Comment::all()->count();
        $num_notifications = User::find(auth()->user()->id)->notifications()->count();

        return view('admin.dashboard')->with([
            'num_users' => $num_users,
            'num_comments' => $num_comments,
            'num_posts' => $num_posts,
            'num_notifications'=> $num_notifications, 
        ]);


    }

    // this function to list all the notifications
    public function listNotifications()
    {
        $notifications = auth()->user()->unReadNotifications;
        
        if (auth()->user()->is_admin){
            
                $num_notifications = count(auth()->user()->unReadNotifications);
                $num_users = User::all()->count();
                $num_posts = Post::all()->count();
                // $num_notifications

                return view('admin.notifications')->with([
                'num_users'     => $num_users,
                'num_posts'     => $num_posts,
                'notifications' => $notifications,
                'num_notifications' => $num_notifications
            ]);


        }

        return view('auth.userNotifications')->with('notifications', $notifications);

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
