<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::with('role')->where('id', Auth::user()->id)->first();

        if($user->role->roles == 'Admin'){
            return redirect('admin')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }

        if($user->role->roles == 'User'){
            return redirect('user')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }
        // return view('home');
    }
}
