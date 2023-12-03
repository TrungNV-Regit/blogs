<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Mail\MailService;
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
}
