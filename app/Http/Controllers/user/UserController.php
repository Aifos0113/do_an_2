<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home_user()
    {


        return view('user.home_user.home_user');
    }
    public function information_user()
    {
        $user = Auth::user();


        return view('user.home_user.information_user' , ['user' => $user]);
    }
    public function update_information_user()
    {

    }
}
