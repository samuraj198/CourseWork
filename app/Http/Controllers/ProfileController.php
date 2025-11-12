<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\History;
use App\Models\User;
use App\Services\HistoryService;
use App\Services\UserService;
use App\Services\WorksService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(private Category $category,
                                private WorksService $worksService,
                                private UserService $userService,
                                private HistoryService $historyService)
    {}
    public function index($login): View
    {
        $user = $this->userService->getUserByLogin($login);
        $categories = $this->category->all();
        $works = $this->worksService->userWorks($user->id);
        $history = $this->historyService->getByUserId($user->id);
        $count = $this->worksService->countOfUserVerificationWorks($user->id);

        return view('pages/profile', compact('user', 'categories', 'works', 'history', 'count'));
    }

    public function adminPanel(): View
    {
        $categories = $this->category->all();
        $files = $this->worksService->getForAdminPanel(request('status'));

        return view('pages/adminPanel', compact('categories', 'files'));
    }
}
