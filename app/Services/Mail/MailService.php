<?php

namespace App\Services\Mail;

use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
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

    public function forgotPassword(Request $request):RedirectResponse
    {
        $to = $request->input('email');
        $subject = 'RT Blog New Password';
        $viewName = 'email.email-forgot-password';
        $newPassword = Str::password(16, true, true, false, false);
        User::where('email', $to)->update(
            [
            'password' => Hash::make($newPassword),
            ]
        );
        Mail::to($to)->send(new SendEmail($subject, $viewName, $newPassword));
        return back()->with("notification", 'Please check your email.');
    }
}
