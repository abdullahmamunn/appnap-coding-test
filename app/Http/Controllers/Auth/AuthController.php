<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVarification;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


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
            'email_varified_token' => Str::random(32)
        ];
     
        try {
            //user create
            User::create($data);
            Mail::to($data['email'])->send(new EmailVarification($data));
            session()->flash('message','User created!');
            session()->flash('key','success');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('key','warning');
            return redirect()->back();
        }
    }
    public function submitLogin(Request $request)
    {
        // return $request->all();
         // check validation
         $request->validate([
            'user_name' => 'required',
            'password' => 'required'
       ]);
       
       try {
            $cred = $request->except(['_token']);
            if(auth()->attempt($cred)){
                
               if(auth()->user()->email_varified === 0)
               {
                    session()->flash('message','Your account is not active! please active your account first to Signin');
                    session()->flash('key','warning');
                    return redirect()->back();
               }
               return redirect()->route('home');

            }
       } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('key','warning');
            return redirect()->back();
       }
      

    }

    public function emailVarify($token=null)
    {
        // chech $token is valid or not
        if($token === null)
        {
            session()->flash('message','Invalid Token');
            session()->flash('key','warning');
            return redirect()->route('register');
        }
        $user = User::where('email_varified_token',$token)->first();
        //dd($user);
        if($user === null)
        {
            session()->flash('message','Invalid Token');
            session()->flash('key','warning');
            return redirect()->route('register');
        }

        //match the token form database
        //update the email_varified and email_varifed_at
        // and set null email_verified_token
       try {
          $data = $user->update([
               'email_varified' =>1,
               'email_verified_at' => Carbon::now(),
               'email_varified_token' => ''
            ]);
            
            session()->flash('message', 'Now Your account is activated! you can SignIn');
            session()->flash('key','success');
            return redirect()->back();

       } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('key','warning');
            return redirect()->back();
       }
    }
}
