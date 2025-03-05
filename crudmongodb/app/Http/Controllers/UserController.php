<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $session;

    public function __construct()
    {
        $this->session = DB::getMongoClient()->startSession();
    }

    public function profileUser()
    {
        if(Auth::user() != null){
            $user = User::find(Auth::user()->_id);
            $sex = '';
            $address_number = '';
            if($user->partner->sex != ''){
                $sex = $user->partner->sex == 'male' ? trans('users.male'):trans('users.female');
            }
            $address_number = $user->partner->noInt == '' ? '#'.$user->partner->noExt:'No.Ext: '.$user->partner->noExt.', #'.$user->partner->noInt;
            return view('user.profile_account',['user' => $user,'sex' => $sex,'address_number' => $address_number]);
        }else{
            abort(404);
        }
    }

    public function profileUserEdit()
    {
        if(Auth::user() != null){
            $user = User::find(Auth::user()->_id);
            return view('user.profile_edit',['user' => $user]);
        }else{
            abort(404);
        }
    }

    public function profileUserPost(Request $request)
    {
        dd($request->all);
        $this->session->startTransaction();
        $this->session->commitTransaction();
    }
}
