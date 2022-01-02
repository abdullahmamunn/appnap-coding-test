<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVarification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NotifyToAdmin;
use App\Notifications\verifyEmail;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
                'phone_number' => 'required',
                'user_name' => 'required|unique:users,user_name',
                'dob' => 'required',
                'password' => 'required|confirmed|min:6'
        ]);

        // $data = [
        //     'full_name' => $request->full_name,
        //     'user_name' => $request->user_name,
        //     'email' => $request->email,
        //     'dob' => $request->dob,
        //     'password' => bcrypt($request->password),
        //     'email_varified_token' => Str::random(32)
        // ];


            //user create
            $user = User::create([
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'dob' => $request->dob,
                'password' => bcrypt($request->password),
                'email_varified_token' => Str::random(32)
            ]);

            // using Mail
            // Mail::to($data['email'])->queue(new EmailVarification($data));

            // using Notification Mail and sms
            $user->notify(new verifyEmail($user));

            // notify to admin when new user added using database notifications
           $admin = User::where('user_name','mamun')->first();
           $admin->notify(new NotifyToAdmin($user));



            session()->flash('message','User created!Please check your Email to verify account');
            session()->flash('key','success');
            return redirect()->back();

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

            session()->flash('message','Sorry! your username or password is incorrect');
            session()->flash('key','warning');
            return redirect()->back();

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

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function passwordReset(Request $request)
    {
        //check validation
        $request->validate([
            'user_name' => 'required'
        ]);
        $user = User::where('user_name',$request->user_name)->first();


        // match username and email

        if($user === null){
            session()->flash('message', 'Your user name is not corrct!');
            session()->flash('key','warning');
            return redirect()->back();
        }


        return view('auth.password-confirm',compact('user'));

    }
    public function passwordConfirm()
    {
        return view('auth.password-confirm');
    }

    public function passwordSubmit(Request $request)
    {
        // return $request->all();
        // check validation
        $request->validate([
            'password' => 'required|confirmed|min:6'
         ]);

         $data = [
             'password' => bcrypt($request->password)
         ];

        $user = User::where('user_name',$request->user_name)->first();
        if($user){
            if($user->email === $request->email)
            {
               $user->update($data);
               session()->flash('message', 'Congratulations! new password set successfully!');
               session()->flash('key','success');
               return redirect()->back();
            }
        }

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
