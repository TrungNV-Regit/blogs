<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SignUpController extends Controller
{

    public function signUpForm()
    {
        return view('auth.sign-up');
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:6',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'min:6',
                'max:30',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,30}$/',
            ],
            'passwordConfirm' => [
                'required',
                'min:6',
                'max:30',
                'same:password',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            User::create([
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect()->route('home')->with('success', 'Check email!');
        }
    }
}
