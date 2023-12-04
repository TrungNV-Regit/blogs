<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\Request;
use App\Services\Mail\MailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VerificationController extends Controller
{
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function verifyEmail(Request $request): View
    {
        return $this->mailService->verifyEmail($request->input('token'));
    }

    public function resendToken(Request $request): View
    {
        return $this->mailService->resendToken($request->input('token'));
    }

    public function forgotPasswordForm(): View
    {
        return view('auth.forgot_password');
    }

    public function forgotPassword(ForgotPasswordRequest $request): RedirectResponse
    {
        return $this->mailService->forgotPassword($request->only(['email']));
    }
}
