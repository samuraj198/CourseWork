<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($login)
    {
        $user = User::where('login', $login)->firstOrFail();
        $categories = Category::all();
        $works = File::where('user_id', $user->id)->where('status', 'Одобрено')->orderBy('created_at', 'desc')->paginate(12);
        $history = History::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(12);
        $count = File::where('user_id', $user->id)->where('status', 'Проверяется')->count();

        return view('pages/profile', compact('user', 'categories', 'works', 'history', 'count'));
    }

    public function adminPanel()
    {
        $categories = Category::all();
        $files = File::query();

        $status = request('status');
        if ($status) {
            $files->where('status', $status);
        }
        $files = $files->orderBy('created_at', 'desc')->paginate(12);

        return view('pages/adminPanel', compact('categories', 'files'));
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
