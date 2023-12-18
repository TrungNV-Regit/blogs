<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManagerUserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagerUserController extends Controller
{
    public function __construct(
        private ManagerUserService $userService,
    ) {
    }

    public function index(Request $request): View
    {
        $username = $request->input('username', '');
        $users = $this->userService->index($username);
        return view('admin.user.index')->with('users', $users);
    }

    public function changeStatus(Request $request): string
    {
        return $this->userService->changeStatus($request->userId);
    }
}
