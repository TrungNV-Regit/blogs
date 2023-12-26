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
        $users = $this->userService->index($request->username, $request->sortTotalBlog);
        return view('admin.user.index')->with('users', $users);
    }

    public function changeStatus(Request $request): string
    {
        return $this->userService->changeStatus($request->userId);
    }

    public function detail(Request $request): View
    {
        $data = $this->userService->detail($request->userId);
        return view('admin.user.detail')->with('data', $data);
    }
}
