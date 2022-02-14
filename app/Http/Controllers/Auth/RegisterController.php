<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * View register index.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Register
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'username' => ['required', 'string', 'min:8', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed']
        ]);

        if(User::where('email', '=', $request->email)->exists()){
            return back()->withInput()->withErrors([
                'email' => 'Email exist.'
            ]);
        }

        if(User::where('username', '=', $request->username)->exists()){
            return back()->withInput()->withErrors([
                'username' => 'Username exist.'
            ]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash:make
        $user->save();

        return redirect('/');
    }
}
