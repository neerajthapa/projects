<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /**
        if (Auth::check() && Auth::user()->user_group_id == 1) {
            return $next($request);
        }
        return redirect('admin/logout');
        **/


    if($exception instanceof \Illuminate\Auth\AuthenticationException ){

  
   return view('admin.login.index');
           // return response('{"status_code":"0","message":"unauthorised access","status_text":"authentication_failed"}', 200);

     }
 



    }

}
