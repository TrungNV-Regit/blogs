<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SignUpController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {
    }

    public function show(): View
    {
        return view('auth.sign_up');
    }

    public function signUp(SignUpRequest $request): RedirectResponse
    {
        return $this->userService->createUser($request->only(['username', 'email', 'password']));
    }
}
