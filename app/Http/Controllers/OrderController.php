<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('account.orders.index', ['orders' => Auth::user()->orders]);
    }

    public function show(Order $order)
    {
        return view('account.orders.show',[
            'order'=>$order
        ]);
    }
}
