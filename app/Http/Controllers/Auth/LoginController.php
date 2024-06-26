<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $asd = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if(auth()->user()->status == 1) {
                if (auth()->user()->is_admin == 1) {
                    return redirect()->route('admin.home');
                } else {
                    if (!isEmpty(auth()->user()->registrationSteps)) {
                        foreach (auth()->user()->registrationSteps as $steps) {
                            if ($steps->status == 0) {
                                return redirect()->route($steps->step);
                            }
                        }
                    } else {
                        return redirect()->route('id-verification');
                    }
                    return redirect()->route('investor.home');
                }
            }
            else{
                auth()->logout();
                return redirect()->route('login')->with('blocked', __('auth.blocked'));
            }
        } else{
            return redirect()->route('login')
                ->with('error','Email and password do not match.');
        }

    }
}
