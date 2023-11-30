<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Services\Auth\AuthenticationService;

class SignInController extends Controller
{
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function signInForm()
    {
        return view('auth.sign-in');;
    }

    public function signIn(SignInRequest $request)
    {
        return $this->authenticationService->signIn($request);
    }
}
