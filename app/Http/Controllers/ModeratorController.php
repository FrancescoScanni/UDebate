<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use App\Models\User;

class ModeratorController extends Controller
{
    public function index()
    {
        $usersCount   = User::count();
        $debatesCount = Debate::count();

        return view('moderator.dashboard', compact('usersCount', 'debatesCount'));
    }
}