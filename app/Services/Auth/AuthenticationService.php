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
            $data = $request->only(['username_or_email', 'password']);
            $user = User::where('email', $data['username_or_email'])->orWhere('username', $data['username_or_email'])->first();
            $password = $data['password'];
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
                $request->session()->regenerate();
                $request->session()->put('user', $user);

                if ($user->role == User::ROLE_ADMIN) {
                    return redirect('/admin/home');
                }

                return redirect('/user/home');
            }
            return back()->withErrors(
                [
                    'password' => 'Incorrect password.',
                ]
            )->onlyInput('username_or_email');
        } catch (Exception $ex) {
            return redirect()->route('exception')->with('error', $ex->getMessage());
        }
    }
}
