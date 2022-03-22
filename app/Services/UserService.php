<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function create(Request $request): User
    {
        return User::forceCreate($this->formatParams($request));
    }

    private function formatParams(Request $request, ?User $user = null): array
    {
        $formatted = [
            'first_name'  => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'dob' => $request->dob,
            'age' => $request->age,
            'home_phone' => $request->home_phone,
            'mobile_phone' => $request->mobile_phone,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
        ];

        return $formatted;
    }

    public function update(User $user, Request $request): void
    {
        $user->forceFill($this->formatParams($request, $user))->save();
    }

    public function delete(User $user): void
    {
        // Check if deletable
        $user->delete();
    }
}
