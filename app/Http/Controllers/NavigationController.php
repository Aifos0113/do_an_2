<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{
    //  Sau khi dang nhap xong -> xac dinh ong nay la ong nao ?
    function authorization()
    {

        $user = Auth::user();

        switch ($user->role){
            case 'user':
                return redirect()->route('home_user');
            case 'admin':
                return redirect()->route('home_admin');

        }
    }
}
