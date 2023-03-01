<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index(){
        return view('account.addresses.index',[
            'user_addresses'=>Auth::user()->userAddresses
        ]);
    }

    public function edit($id){
        return view('account.addresses.edit',[
            'address'=>Address::find($id)
        ]);
    }

    public function update(UserAddress $address, Request $request){
        $request->validate([
            'is_shipping_address'=>'required|boolean'
        ]);

        $address->user_address_is_shipping = $request->is_shipping_address;
        $address->save();
        return back();
    }
}
