<?php

namespace App\Services\User;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{

    public function createUser(array $data): User
    {
        $token = base64_encode($data['email']);
        $url = config('app.constants.BASE_URL') . '/auth/verify-email?token=' . $token;
        $to = $data['email'];
        $user = User::create(
            [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'token_verify_email' => $token,
                'link_avatar' => config('app.constants.AVATAR_DEFAULT'),
            ]
        );
        Mail::to($to)->send(new SendEmail($url));
        return $user;
    }
}
