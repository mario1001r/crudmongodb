<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profileUser()
    {
        $user = User::find(Auth::user()->_id);
        return view('user.profile_account',['user' => $user]);
    }
}
