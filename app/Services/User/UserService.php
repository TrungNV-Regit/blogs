<?php

namespace App\Services\User;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function createUser(array $data): User
    {
        $token = base64_encode($data['email']);
        $user = User::create(
            [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'token_verify_email' => $token,
                'role' => User::ROLE_USER,
                'status' => User::STATUS_ACTIVE,
                'link_avatar' => config('app.constants.AVATAR_DEFAULT'),
                'token_created_at' => now(),
            ]
        );
        Mail::to($data['email'])->send(new SendEmail(__('en.subject_verify_email'), 'mail.verify_email', $token));
        return $user;
    }
}
