<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserListService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, UserListService $service)
    {
        return $service->paginate($request);
    }

    public function store(UserRequest $request, UserService $service)
    {
        $user = $service->create($request);

        return $this->success([
            'message' => 'User created.',
            'user' => new UserResource($user)
        ]);
    }

    public function show(User $user) : UserResource
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user, UserService $service)
    {
        $service->update($user, $request);

        return $this->success(['message' => 'User updated.']);
    }

    public function destroy(User $user, UserService $service)
    {
        $service->delete($user);

        return $this->success(['message' => 'User deleted.']);
    }
}
