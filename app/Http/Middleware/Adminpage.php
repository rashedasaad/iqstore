<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminpage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = $request->session()->get("admin");
      

 
        if(!isset($_COOKIE["dsfsde3wrfds"])){
            return abort(404);
        }
        if ($_COOKIE["dsfsde3wrfds"] == null) {
            return abort(404);
        }
            if ($_COOKIE["dsfsde3wrfds"] == "sdirfyw8493509234irjefdns98230wjsdkbro8pse9upidji") {
                if(!$admin){
                    return redirect("/");  
                }
                return $next($request);
            }
        
       

    }
}
