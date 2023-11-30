<?php

namespace App\Services\Mail;

use App\Models\User;

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
}
