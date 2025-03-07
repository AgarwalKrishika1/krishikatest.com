<?php

// namespace App\Http\Controllers\Auth;

// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\RedirectResponse;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Support\Facades\Cookie;

// class LoginController extends Controller
// {
//     /*
//     |--------------------------------------------------------------------------
//     | Login Controller
//     |--------------------------------------------------------------------------
//     |
//     | This controller handles authenticating users for the application and
//     | redirecting them to your home screen. The controller uses a trait
//     | to conveniently provide its functionality to your applications.
//     |
//     */

//     use AuthenticatesUsers;

//     /**
//      * Where to redirect users after login.
//      *
//      * @var string
//      */
//     protected $redirectTo = RouteServiceProvider::HOME;

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }

//     public function login(Request $request): RedirectResponse

//     {   

//         $input = $request->all();

     

//         $this->validate($request, [

//             'email' => 'required|email',

//             'password' => 'required',

//         ]);

     

//         if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))

//         {

//             if (auth()->user()->type == 'admin') {

//                 return redirect()->route('admin.home');

//             }else{
                
//                 return redirect('/');

//             }

//         }else{

//             return redirect()->route('login')

//                 ->with('error','Email-Address And Password Are Wrong.');

//         }
//     }


// }

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if(!$user->email_verified_at){
                return redirect()->route('login')->with('status', 'Please verify your email before logging in.');
            }
            if($user->type == 'admin'){
                return redirect()->route('admin.index');
            }
           
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
