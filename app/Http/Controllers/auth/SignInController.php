<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class SignInController extends Controller
{
    public function signInForm()
    {
        return view('auth.sign-in');;
    }
}
