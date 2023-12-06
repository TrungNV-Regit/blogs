<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\View\View;
use App\Services\Auth\AuthenticationService;
use Illuminate\Http\RedirectResponse;

class SignInController extends Controller
{
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }
    
    public function signInForm(): View
    {
        return view('auth.sign_in');
    }

    public function signIn(SignInRequest $request): RedirectResponse
    {
        return $this->authenticationService->signIn($request);
    }

    public function logout(): RedirectResponse
    {
        return  $this->authenticationService->logout();
    }
}
