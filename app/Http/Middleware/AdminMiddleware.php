<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()){

            $user = User::with('role')->where('id', Auth::user()->id)->first();

            if ( auth()->check() && $user->role->roles == 'Admin' ) {
                return $next($request);
            }

            return redirect('login')->with('status', [
                'enabled' => true,
                'type' => 'danger',
                'content' => 'Tidak boleh mengakses'
            ]);
        }
    }
}
