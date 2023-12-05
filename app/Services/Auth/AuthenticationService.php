<?php

namespace App\Services\Auth;

use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthenticationService
{
    /**
     * Handle an authentication attempt.
     */
    public function signIn(SignInRequest $request): RedirectResponse
    {
        try {
            $data = $request->only(['usernameOrEmail', 'password']);
            $usernameOrEmail = $data['usernameOrEmail'];
            $user = User::where('email', $usernameOrEmail)->orWhere('username', $usernameOrEmail)->first();
            $password = $data['password'];

            if ($user) {
                if (Hash::check($password, $user->password)) {

                    if ($user->email_verified_at === null) {
                        return back()->with('notification', trans('message.notVerified'));
                    }

                    if ($user->status == User::STATUS_BLOCKED) {
                        return back()->with('notification', trans('message.account_blocked'));
                    }

                    if ($request->has('remember')) {
                        Auth::login($user, true);
                    }

                    Auth::login($user);

                    if ($user->role == User::ROLE_ADMIN) {
                        return redirect()->route('admin.home');
                    }

                    return redirect()->route('/');
                }
            }

            return back()->with('error', trans('message.account_not_found'))->onlyInput('usernameOrEmail');
        } catch (Exception $ex) {
            return redirect()->route('exception')->with('error', $ex->getMessage());
        }
    }

    public function logout(): RedirectResponse
    {
        try {
            Auth::logout();
            return redirect()->route('auth.sign-in');
        } catch (Exception $ex) {
            return redirect()->route('exception')->with('error', $ex->getMessage());
        }
    }
}
