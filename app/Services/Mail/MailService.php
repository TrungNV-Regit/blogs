<?php

namespace App\Services\Mail;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Exception;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;


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

                if ($tokenCreatedAt->diffInMinutes($now) < config('blog.valid_token_duration')) {
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
            throw new Exception($ex->getMessage());
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

    public function forgotPassword(array $data): RedirectResponse
    {
        try {
            $user = User::where('email', $data['email'])->first();
            if ($user) {
                
                if ( $user->email_verified_at == null ) {
                    return back()->with("notification", trans("message.notVerified"));
                }

                $to = $user->email;
                $newPassword = Str::password(16, true, true, false, false);
                User::where('email', $to)->update(
                    [
                        'password' => Hash::make($newPassword),
                    ]
                );
                Mail::to($to)->send(new SendEmail(__('message.new_password'), 'mail.email_forgot_password', $newPassword));
                return back()->with("notification", trans("message.forgot_password_success"));
            }
            return back()->with("error", trans('message.email_not_found'));
        } catch (Exception $ex) {
            return redirect()->route('exception')->with('error', $ex->getMessage());
        }
    }
}
