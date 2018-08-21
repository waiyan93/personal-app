<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    public function login(Request $request)
    {
        // validate the request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        // attempt to log the user in
        if(Auth::guard('admin')->attempt([
            'email' => $request->email, 
            'password' =>  $request->password
        ], $request->remember)) {
            // if successful redirect to the intented location
            return redirect()->intended(route('admin.dashboard'));
        }else{
            // if unsuccessful then redirect back to login with form data
            return redirect()->back()->withInput($request->only('email', 'remember')) ;
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
