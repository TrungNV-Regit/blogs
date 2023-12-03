<?php

namespace App\Services\Mail;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Exception;
use Illuminate\View\View;

class MailService
{
    public function verifyEmail(string $token): View
    {
        try {
            $user = User::where("token_verify_email", $token)
                ->where('email_verified_at', null)
                ->first();
            if ($user) {
                $tokenCreatedAt = Carbon::parse($user->token_created_at);
                $now = now();

                if ($tokenCreatedAt->diffInMinutes($now) < config('app.valid_token_duration')) {
                    $user->update(['email_verified_at' => now()]);
                    $data = [
                        'success' => trans('message.email_verification_success'),
                    ];
                    return view('auth.verify_token', compact('data'));
                }
                $data = [
                    'token_out_time' => trans('message.token_out_time'),
                    'token' => $token,
                ];
                return view('auth.verify_token', compact('data'));
            }
            $data = [
                'error' => trans('message.email_verification_error'),
            ];
            return view('auth.verify_token', compact('data'));
        } catch (Exception $ex) {
            return view('error.exception')->with('error', $ex->getMessage());
        }
    }

    public function resendToken(string $token): View
    {
        try {
            $user = User::where('token_verify_email', $token)->first();
            $user->update(['token_created_at' => now()]);
            Mail::to($user->email)->send(new SendEmail(__('en.subject_verify_email'), 'mail.verify_email', $token));
            $data = [
                'resend_token_success' => trans('message.resend_token_success'),
            ];
            return view('auth.verify_token', compact('data'));
        } catch (Exception $ex) {
            return view('error.exception')->with('error', $ex->getMessage());
        }
    }
}
