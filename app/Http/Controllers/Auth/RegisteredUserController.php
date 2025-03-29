<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userData = $request->validate([
            'ava' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ],
        [
            'login.unique' => 'Такой логин уже зарегистрирован',
            'email.unique' => 'Такая почта уже зарегистрирована',
        ]);

        if ($request->hasFile('ava')) {
            $ava = $request->file('ava');
            $photoName = $request->input('login') . '_' . now()->format('YmdHis') . '.' . $ava->getClientOriginalExtension();

            $ava->storeAs('avatars', $photoName, 'public');
            $userData['ava'] = $photoName;
        } else {
            $userData['ava'] = null;
        }

        $user = User::create($userData);

        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('profile', auth()->user()->login)
        ->with('success', 'Аккаунт успешно зарегистрирован. Вход выполнен');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
