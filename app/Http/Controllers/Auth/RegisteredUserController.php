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

    public function __construct(UserService $service)
    {}

    public function index()
    {
        return view('pages.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $userData = $request->validated();

        $user = $this->register($userData);

        return redirect()->route('profile', $user->login)
            ->with('success', 'Аккаунт успешно зарегистрирован. Вход выполнен');
    }
}
