<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function register($userData)
    {
        $user = User::create($userData);
        Auth::login($user);

        return $user;
    }
}
