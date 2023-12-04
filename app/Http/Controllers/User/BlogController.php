<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function myBlogs(): View
    {
        return view('user.my_blogs');
    }
}
