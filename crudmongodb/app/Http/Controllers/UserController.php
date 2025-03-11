<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\Theme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $session;

    public function __construct()
    {
        $this->session = DB::getMongoClient()->startSession();
    }

    public function calculateAge($birthday)
    {
        $age = Carbon::now()->diffInYears($birthday);
        return intval($age);
    }

    public function profileUser()
    {
        if (Auth::user() != null) {
            $user = User::find(Auth::user()->_id);
            $sex = '';
            $address_number = '';
            if ($user->partner->sex != '') {
                $sex = $user->partner->sex == 'male' ? trans('users.male') : trans('users.female');
            }
            $address_number = $user->partner->noInt == '' ? '#' . $user->partner->noExt : 'No.Ext: ' . $user->partner->noExt . ', #' . $user->partner->noInt;
            return view('user.profile_account', ['user' => $user, 'sex' => $sex, 'address_number' => $address_number]);
        } else {
            abort(404);
        }
    }

    public function profileUserEdit()
    {
        if (Auth::user() != null) {
            $user = User::find(Auth::user()->_id);
            $countries = Country::orderBy('name', 'ASC')->get();
            $age = Carbon::now()->diffInYears($user->partner->birthday);
            return view('user.profile_edit', ['user' => $user, 'countries' => $countries, 'age' => $age]);
        } else {
            abort(404);
        }
    }

    public function profileUserPost(Request $request)
    {
        if (Auth::user() != null) {
            $this->session->startTransaction();

            $user = User::find(Auth::user()->_id);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            $partner = Partner::where('user_id', $user->_id)->first();
            $partner->first_name = $request->first_name;
            $partner->last_name = $request->last_name;
            $partner->phone_number = $request->phone_number;
            $partner->movil = $request->movil;
            $partner->sex = $request->sex;
            $partner->street = $request->street;
            $partner->noExt = $request->noExt;
            $partner->noInt = $request->noInt;
            $partner->colony = $request->colony;
            $partner->postal_code = $request->postal_code;
            $partner->birthday = $request->birthday;
            $partner->age = intval($request->age_input);
            $partner->country_id = intval($request->country_select);
            $partner->state_id = intval($request->state_select);
            $partner->city_id = intval($request->city_select);
            $partner->save();

            $this->session->commitTransaction();
            Session::flash('message', 'El perfil ' . $user->partner->first_name . ' se ha actualizado correctamente !');
            return redirect(url('/profile/user'));
        } else {
            abort(404);
        }
    }

    public function changePasswordForm()
    {
        if (Auth::user() != null) {
            return view('user.update_password');
        } else {
            abort(404);
        }
    }

    public function changePasswordPost(Request $request)
    {
        $user = User::find(Auth::user()->_id);
        if ($user != null) {
            // Hola1020
            $validation = Validator::make($request->all(), [
                'current_password' => 'required|string|min:8',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8'
            ]);
            if ($validation->fails()) {
                return redirect('/profile/user/password')->withErrors($validation)
                    ->withInput();
            }
            // comparamos la contraseña introducida con la actual de la base de datos
            $check_old_password = Hash::check($request->current_password, $user->password);
            if ($check_old_password) {
                $user->password = bcrypt($request->password);
                $user->save();
                Session::flash('message', 'Tu contraseña ' . $user->partner->first_name . ' ha sido actualizada existosamente!');
                return redirect(url('/home'));
            } else {
                return response()->json(['message' => 'Verificación de contraseña incorrecta']);
            }
        } else {
            abort(404);
        }
    }

    public function settingsForm()
    {
        $setting = Setting::where('user_id', Auth::user()->_id)->first();
        $themes = Theme::get(['_id', 'id', 'name']);
        return view('user.settings', ['setting' => $setting, 'themes' => $themes]);
    }

    public function settingsPost(Request $request)
    {

        $setting = Setting::where('user_id', Auth::user()->_id)->first();
        $this->session->startTransaction();
        if ($request->lang_select != null) {
            $setting->language = $request->lang_select;
        }
        if ($request->theme_select != null) {
            $setting->theme_id = intval($request->theme_select);
        }
        $setting->save();
        $this->session->commitTransaction();
        Session::flash('message', 'Tus preferencias ' . Auth::user()->partner->first_name . ' se ha actualizado correctamente!');
        return redirect(url('/profile/user/settings'));
    }
}
