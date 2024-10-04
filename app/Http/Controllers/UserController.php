<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($login)
    {
        $user = User::where('login', $login)->firstOrFail();
        if($user->id == auth()->user()->id) {
            return redirect()->route('profile');
        }
        $categories = Category::all();
        $works = File::where('user_id', $user->id)->get();

        return view('pages/profile', compact('user', 'categories', 'works'));
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
