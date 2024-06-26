<?php

namespace App\Http\Middleware;

use App\Models\RegistrationStep;
use Closure;
use Illuminate\Http\Request;

class IdVerification
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
        $reg_step = RegistrationStep::whereuser_id(auth()->user()->id)->wherestep('id-verification')->first();
        if(!empty($reg_step)){
            if ($reg_step->status == 0) {
                return $next($request);
            } else{
                return redirect()->route('investor.home');
            }
        } else{
            return $next($request);
        }
        return redirect()->back();
    }
}
