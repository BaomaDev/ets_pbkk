<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function admin() {
        return view('admin.dashboard');
    }

    public function user() {
        return view('user.home');
    }
}
