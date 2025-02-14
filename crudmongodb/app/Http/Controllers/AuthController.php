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
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginFormPost(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);
        $request_login = $request->login;
        $user = User::where('email',$request_login)
            ->Orwhere('username',$request_login)->first();
        if($request->remember == 'on'){
            $user->remember_token = $request->_token;
            $user->save();
        }
        $credentials = $request->only('password');

        if($user != null){
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $request_login;
            } else {
                $credentials['username'] = $request_login;
            }
            // Intentamos autenticar al usuario
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }

            throw ValidationException::withMessages([
                'password' => ['Contraseña incorrecta']
            ]);
        }else{
            Session::flash('message','No existen ninguna cuenta asociada con este correo o usuario '.$request_login);
            return redirect(url('/login'))
                    ->withErrors(['login' => 'Correo incorrecto',
                        'password' => 'Contraseña incorrecta']);
        }
        
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
        $token = $request->_token;
        if($user != null){
            $url = url('/password/reset/'.$token.'/'.$user->email);  
            Mail::to($user->email)
                ->send(new ResetPasswordEmail($user,$token,$url));
            Session::flash('message', 
                'El link de restablecimiento  de contraseña ha sido enviado al correo <b>' . $user->email . '</b> exitosamente!');
            return redirect(url('/password/reset'));
        }
        return redirect(url('/password/reset'))->withInput();
    }

    public function showFormResetPassword($token,$email)
    {
        $user = User::where('email',$email)->first();
        if($user != null){
            return view('auth.passwords.reset',
            ['user' => $user,'token' => $token]);
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
            $credentials = $request->only('email','password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }
            //Session::flash('message', 'La contraseña de  <b>' . $user->username . '</b> ha sido actualizada correctamente !');
            //return redirect('/login');
        }
        return back()->withInput();
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function registerUserPost(Request $request) 
    {
        $session = DB::getMongoClient()->startSession();
        $validation = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validation->fails()) {
            return redirect(url('/register'))->withErrors($validation)
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
