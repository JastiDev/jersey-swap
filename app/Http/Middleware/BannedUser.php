<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannedUser
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
        $user = Auth::user();
        if($user->role->role!=="admin" && $user->banned!=="null"){
            if($user->banned){
                $message = $user->username."! Your account has been banned. For more details contact the Jersey Swap Support Team!";
                Session::flush();
                return redirect('banned')->with('error',$message);
            }
        }
        return $next($request);
    }
}
