<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->orderBy('name')->paginate(20),
            'roles' => User::roleOptions(),
        ]);
    }

    public function store(StoreAdminUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return back()->with('status', 'System administrator created successfully.');
    }

    public function update(UpdateAdminUserRoleRequest $request, User $user): RedirectResponse
    {
        if ($user->is($request->user()) && $request->validated('role') !== User::ROLE_SUPER_ADMIN) {
            return back()->withErrors(['role' => 'You cannot remove your own Super Admin access.']);
        }

        $user->update($request->validated());

        return back()->with('status', "Role updated for {$user->name}.");
    }
}
