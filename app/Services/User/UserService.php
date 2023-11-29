<?php

namespace App\Services\User;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\User\MailService;
use Illuminate\Support\Facades\Mail;


class UserService
{
    public function __construct()
    {
    }

    public function createUser(array $data):User
    {
        $token=base64_encode($data['email']);
        $url='http://localhost:8000/auth/verify-email?token='.$token;
        $to=$data['email'];
        $user= User::create(
            [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'token_verify_email'=>$token,
            ]
        );
        Mail::to($to)->send(new SendEmail($url));
        return $user;
    }
}
