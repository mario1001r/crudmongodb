<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public function registerUser(Request $request) 
    {
        /***
         *  $validation = Validator::make($request->all(), [
            'username' => 'required', 'string', 'max:255','unique:users',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);
         */
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
