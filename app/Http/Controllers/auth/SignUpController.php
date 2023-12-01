<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Services\User\UserService;

class SignUpController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function signUpForm()
    {
        return view('auth.sign_up');
    }

    public function signUp(SignUpRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->back()->with('success', trans('message.sign_up_success'));
    }
}
