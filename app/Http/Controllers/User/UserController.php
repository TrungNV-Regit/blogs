<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
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

    public function showChangePasswordForm(): View
    {
        return view('user.change_password');
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $this->userService->resetPassword($request->only(['currentPassword', 'password']));
        return redirect()->route('index')->with('notification', __('message.change_password_success'));
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
