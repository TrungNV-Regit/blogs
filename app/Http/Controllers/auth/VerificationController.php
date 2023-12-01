<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Mail\MailService;

class VerificationController extends Controller
{
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function verifyEmail(Request $request)
    {
        return $this->mailService->verifyEmail($request->input('token'));
    }

    public function resendToken(Request $request)
    {
        return $this->mailService->resendToken($request->input('token'));
    }
}
