<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Mail\SendEmail;
use App\Services\User\MailService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SignUpController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function signUpForm()
    {
        return view('auth.sign-up');
    }

    public function signUp(SignUpRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->back()->with('success', "Account successfully registered.");
    }
}
