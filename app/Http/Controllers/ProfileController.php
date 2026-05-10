<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function profileView(User $user)
    {
        return view('profile', compact('user'));
    }
}
