<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function dashboard(){
        return view('account.dashboard');
    }

    public function profile(){
        return view('account.profile.index');
    }

    public function orders(){
        return view('account.orders.index',[
            'orders'=>Auth::user()->orders
        ]);
    }

    public function billing(){
        return view('account.billing.index');
    }
}
