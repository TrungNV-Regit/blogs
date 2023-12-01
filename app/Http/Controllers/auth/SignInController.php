<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;

class SignInController extends Controller
{
    public function signInForm()
    {
        return view('auth.sign-in');
    }
}
