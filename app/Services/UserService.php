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
        if ($userData->hasFile('ava')) {
            $ava = $userData->file('ava');
            $photoName = $userData->input('login') . '_' .
                now()->format('YmdHis') . '.' .
                $ava->getClientOriginalExtension();
            $ava->storeAs('avatars', $photoName, 'public');
            $userData['ava'] = $photoName;
        } else {
            $userData['ava'] = null;
        }

        $user = User::create($userData);
        Auth::login($user);

        return $user;
    }
}
