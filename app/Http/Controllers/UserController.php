<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\koperasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = User::with('role')->where('id', Auth::user()->id)->first();
        $role = $user->role->roles;
        return view('user.dashboard', compact('role'));
    }
}
