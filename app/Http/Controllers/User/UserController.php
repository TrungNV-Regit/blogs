<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
    ) {
    }

    public function showResetPasswordForm(): View
    {
        return view('user.reset_password');
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $result = $this->userService->resetPassword($request->only(['oldPassword', 'password']));
        if ($result) {
            return back()->with('notification', __('message.reset_password_success'));
        }
        return back()->withErrors(['oldPassword' => __('message.old_password_incorrect')]);
    }

    public function show(): View
    {
        return view('user.profile')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $hasChanges = $request->filled('username') || $request->hasFile('image');
        if ($hasChanges) {
            $this->userService->updateProfile($request);
            return back()->with('notification', __('message.update_profile_success'));
        }
        return back()->with('notification', __('message.profile_unchanged'));
    }
}
