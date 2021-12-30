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

        $data = [
            'full_name' => $request->full_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'dob' => $request->dob,
            'password' => bcrypt($request->password),
        ];
        try {
            //user create
            User::create($data);
            session()->flash('message','User created!');
            session()->flash('key','success');
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function submitLogin(Request $request)
    {
         // check validation
         $request->validate([
            'user_name' => 'required|user_name',
            'password' => 'required'
       ]);

       $cred = $request->except(['_token']);

    }
}
