<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function posts()
    {
        return view('admin.posts.index');
    }

    public function videos()
    {
        return view('admin.videos.index');
    }

    public function users()
    {
        return view('admin.users.index');
    }

    public function categories()
    {
        return view('admin.categories.index');
    }

    public function ads()
    {
        return view('admin.ads.index');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }
}
