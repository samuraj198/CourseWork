<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private UserService $service)
    {}

    public function index()
    {
        return view('pages.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $userData = $request->validated();

        if ($request->hasFile('ava')) {
            $ava = $request->file('ava');
            $photoName = $userData['login'] . '_' .
                now()->format('YmdHis') . '.' .
                $ava->getClientOriginalExtension();
            $ava->storeAs('avatars', $photoName, 'public');
            $userData['ava'] = $photoName;
        } else {
            $userData = null;
        }

        $user = $this->service->register($userData);

        return redirect()->route('profile', $user->login)
            ->with('success', 'Аккаунт успешно зарегистрирован. Вход выполнен');
    }
}
