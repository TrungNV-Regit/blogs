<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;


class SignUpController extends Controller
{

    public function signUpForm()
    {
        return view('auth.sign-up');
    }

    public function signUp(SignUpRequest $request)
    {
        $user = User::create($request->validated());
        return redirect('home')->with('success', "Account successfully registered.");

    }
}
