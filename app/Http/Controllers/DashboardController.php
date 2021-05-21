<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // if (auth()->user()->is_admin) {
        //     return redirect(route('profile'));
        // }

        dd('index');
    }

    public function profile()
    {
        return view('auth.dashboard');
    }
}
