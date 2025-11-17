<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkUserOnline
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
        $response =  $next($request);

        if(auth()->user()){
            \App\Models\User::whereId(auth()->user()->id)->update([
                'logged_in' => 1,
            ]);
        }

        return $response;
    }
}
