<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use App\Models\User;

class ModeratorController extends Controller
{
    public function index()
    {
        $allDebates   = Debate::with(['user', 'comments', 'likes'])->latest()->get();
        $usersCount   = User::count();
        $debatesCount = Debate::count();

        return view('moderator.dashboard', compact(
            'allDebates', 'usersCount', 'debatesCount'
        ));
    }
}