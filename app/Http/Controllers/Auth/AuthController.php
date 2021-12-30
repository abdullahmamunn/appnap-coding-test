<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.registration');
    }
    public function submitRegister(Request $request)
    {
        return $request->all();
    }
    public function submitLogin(Request $request)
    {
        return $request->all();
    }
}
