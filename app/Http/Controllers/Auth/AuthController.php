<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;

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
        // check validation
        $request->validate([
                'full_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'user_name' => 'required|unique:users,user_name',
                'dob' => 'required',
                'password' => 'required|confirmed|min:6'
        ]);

        try {
            //user create
            User::create($request->all());
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function submitLogin(Request $request)
    {
        return $request->all();
    }
}
