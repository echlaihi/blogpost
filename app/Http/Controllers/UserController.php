<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $num_users = User::all()->count();
        $num_posts = Post::all()->count();
        $num_notifications = count(auth()->user()->unreadNotifications);
        return view('admin.tables.users')->with(['num_notifications' => $num_notifications, 'users' => $users, 'num_users' => $num_users, 'num_posts' => $num_posts]);
    }


    public function update(User $user, Request $request)
    {
        $this->authorize('updatePrivleges',$user);
        $user->update($this->makeDataFromRequest($request));

    }   

    private function makeDataFromRequest($request)
    {
        return [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'is_admin' => $request->input('is_admin'),
        ];
    }
}
