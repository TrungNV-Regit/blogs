<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\View\View;

class SignInController extends Controller
{
    public function signInForm(): View
    {
        return view('auth.sign_in');
    }
}
