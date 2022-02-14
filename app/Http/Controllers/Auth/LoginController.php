<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * View login page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            $this->username($request) => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.'
        ]);
    }

    /**
     * Credential type check.
     *
     * @param Request $request
     * @return string
     */
    public function username(Request $request)
    {
        $user = $request->username;
        if(filter_var($user, FILTER_VALIDATE_EMAIL)){
            $type = 'email';
        }else{
            $type = 'username';
        }
        $request->merge([$type => $user]);
        return $type;
    }
}
