<?php

namespace App\Http\Middleware;

use App\Models\RegistrationStep;
use Closure;
use Illuminate\Http\Request;

class CheckInvestorSteps
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
        $reg_step_general_info = RegistrationStep::whereuser_id(auth()->user()->id)->wherestep('general-info')->first();
        $reg_step_financial_status = RegistrationStep::whereuser_id(auth()->user()->id)->wherestep('financial-status')->first();
         if (empty($reg_step_general_info)){
            return redirect()->route('general-info');
        } else if(empty($reg_step_financial_status)){
            return redirect()->route('financial-status');
        } else{
            return $next($request);
         }
    }
}
