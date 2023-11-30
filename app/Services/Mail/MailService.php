<?php

namespace App\Services\Mail;

use App\Http\Requests\SignInRequest;
use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function verifyEmail(string $token): bool
    {
        $user = User::where("token_verify_email", $token)
            ->where('email_verified_at', null)
            ->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();
            return true;
        }
        return false;
    }

    public function forgotPassword(SignInRequest $request):RedirectResponse
    {
        $to = $request->input('email');
        $subject = 'RT Blog New Password';
        $viewName = 'email.email-forgot-password';
        $regex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,30}$/';
        $randomString = Str::random(8);
        $newPassword = Str::regexReplace($regex, $randomString, '');
        User::where('email', $to)->update(
            [
            'password' => Hash::make($newPassword),
            ]
        );
        Mail::to($to)->send(new SendEmail($subject, $viewName, $newPassword));
        return back()->with("notification", 'Please check your email.');
    }
}
