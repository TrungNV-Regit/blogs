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
        $token = $request->input('token');
        if ($this->mailService->verifyEmail($token)) {
            $data = [
                'success' => 'Email verification successful'
            ];
            return view('auth.verify-token', compact('data'));
        }
        $data = [
            'error' => 'Email verification error'
        ];
        return view('auth.verify-token', compact('data'));
    }
}
