<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function validateEmail($email)
    {
        $email_query = User::where('email',$email)->first();
        if($email_query != null){
            return response()->json(['result' => true,'message' => 'El correo electrónico ya existen']);
        }
    }

    public function validateUsername($username)
    {
        $username_query = User::where('username',$username)->first();
        if($username_query != null){
            return response()->json(['result' => true,'message' => 'El usuario ya existen']);
        }
        
    }

    public function showPasswordReset()
    {
        return view('auth.passwords.email');
    }

    public function sendEmailPasswordReset(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user != null){
            $url = url('/password/reset/'.$user->_id.'/'.$user->email);  
            Mail::to($user->email)
                ->send(new ResetPasswordEmail($user,$url));
        }
        return redirect('/password/reset')->withInput();
    }

    public function showFormResetPassword($user_id,$email)
    {
        $user = User::where('_id',$user_id)->where('email',$email)->first();
        if($user != null){
            return view('auth.passwords.reset',['user' => $user]);
        }
    }

    public function resetPasswordPost(Request $request)
    {
        $session = DB::getMongoClient()->startSession();
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation)
                ->withInput();
        }
        $user = User::findOrFail($request->_id);
        if($user != null){
            $session->startTransaction();
            $user->password = bcrypt($request->password);
            $user->save();
            $session->commitTransaction();
            Session::flash('message', 'La contraseña de  <b>' . $user->username . '</b> ha sido actualizada correctamente !');
            return redirect('/login');
        }
        return back()->withInput();
    }

    public function registerUser(Request $request) 
    {
        $session = DB::getMongoClient()->startSession();
        $validation = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validation->fails()) {
            return redirect('/register-user')->withErrors($validation)
                ->withInput();
        }
        $credentials = $request->only('email','password');
        $session->startTransaction();
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = 'user';
        $user->save();

        $partner = new Partner();
        $partner->first_name = $request->first_name;
        $partner->last_name = $request->last_name;
        $partner->user_id = $user->_id;
        $partner->save();

        // Tema 2 = cosmo
        $setting = new Setting();
        $setting->language = 'es';
        $setting->user_id = $user->_id;
        $setting->theme_id = 2;
        $setting->save();
        $session->commitTransaction();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }


    }
}
