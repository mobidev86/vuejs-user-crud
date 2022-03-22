<?php

namespace App\Services;

use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UserListService
{

    public function paginate(Request $request) : UserCollection
    {
        return new UserCollection(User::query()
            ->orderBy('created_at', 'desc')
            ->paginate(20, ['*'], 'current_page'));
    }
}
