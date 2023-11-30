<?php

namespace App\Services\Mail;

use Illuminate\Support\Facades\DB;

class MailService
{
    public function verifyEmail(string $token): bool
    {
        $user = DB::table("users")
            ->where("token_verify_email", $token)
            ->where('email_verified_at', null)
            ->first();
        if ($user) {
            DB::table("users")
                ->where("token_verify_email", $token)
                ->update(["email_verified_at" => now()]);
            return true;
        } else {
            return false;
        }
    }
}
