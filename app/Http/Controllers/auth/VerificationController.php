<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class VerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $token = $request->input('token');
    }
}
