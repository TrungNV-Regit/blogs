<?php

namespace App\Services\Auth;

use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    /**
     * Handle an authentication attempt.
     */
    public function signIn(SignInRequest $request): RedirectResponse
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $password = $request->input('password');
        if (Hash::check($password, $user->password)) {

            if ($user->email_verified_at === null) {
                return back()->with('notVerified', "Email has not been verified.");
            }

            if ($user->status == config('app.constants.STATUS_BLOCKED')) {
                return back()->with('blocked', "Your account has been locked.");
            }

            if ($request->has('remember')) {
                Auth::login($user, true);
            }
            $request->session()->regenerate();
            $request->session()->put('user', $user);

            if($user->role == config('app.constants.ROLE_ADMIN')){
                return redirect('/admin');
            }

            return redirect('/home');
        }
        return back()->withErrors(
            [
            'password' => 'Incorrect password.',
            ]
        )->onlyInput('email');
    }
}
