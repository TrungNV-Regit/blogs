<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(): View
    {
        return view('user.home');
    }

}
