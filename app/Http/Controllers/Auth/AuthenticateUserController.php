<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth');
    }

    public function login(Request $request)
    {
        $data = $request->only('login', 'password');

        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->intended(route('profile', auth()->user()->login))
            ->with('success', 'Вы успешно вошли в аккаунт');
        } else {
            return back()->withErrors('Не удалось войти в аккаунт');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Вы успешно вышли из аккаунта');
    }
}
