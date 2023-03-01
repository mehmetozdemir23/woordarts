<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\GuestOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentFormForGuest(Request $request)
    {

        $request->validate([
            'guest_order_id' => 'required|numeric',
            'guest_order' => 'required',
            'guest_order.user' => 'required',
            'guest_order.user.firstname' => 'required',
            'guest_order.user.lastname' => 'required',
            'guest_order.user.email' => 'required',
            'guest_order.user.phone' => 'nullable',
            'guest_order.shipping_address' => 'required',
            'guest_order.shipping_address.address_line_1' => 'required',
            'guest_order.shipping_address.address_line_2' => 'nullable',
            'guest_order.shipping_address.city' => 'required',
            'guest_order.shipping_address.postal_code' => 'required',
            'guest_order.shipping_address.region' => 'nullable',
            'guest_order.shipping_address.country' => 'required'
        ]);

        $guest_order = GuestOrder::find($request->guest_order_id);
        if ($guest_order) {

            Cart::reset();

            $guest_order->guest_order_user_infos = json_encode($request->guest_order['user']);
            $guest_order->guest_order_shipping_address = json_encode($request->guest_order['shipping_address']);
            $guest_order->save();
            $message_type = 'success';
            $message_content = 'Your order has been successfully placed!';
            $expiration = now()->addSeconds(10);
            $request->session()->put('success', $message_content, $expiration);

            return redirect(route('cart.index'))->with($message_type, $message_content);
        }

        $message_content = 'Please fill the form correctly.';
        return back()->with([
            'guest_order_id' => $request['guest_order_id'],
        ]);
    }

    public function showPaymentFormForAuth(Request $request)
    {
        $request->validate([
            'auth_user_id' => 'required|exists:users,id',
            'auth_user_order_id' => 'required|numeric',
            'shipping_address_id' => 'required|numeric'
        ]);

        $auth_user_order = Order::find($request->auth_user_order_id);
        if ($auth_user_order) {

            Cart::reset();

            $auth_user_order->shipping_address_id = $request->shipping_address_id;
            $auth_user_order->payment_type_id = 1;
            $auth_user_order->save();
            $message_type = 'success';
            $message_content = 'Your order has been successfully placed!';
            $expiration = now()->addSeconds(10);
            $request->session()->put('success', $message_content, $expiration);
            return redirect(route('account.profile.index'))->with($message_type, $message_content);
        } else {
            $message_type = 'error';
            $message_content = 'Please fill the form correctly.';
            $expiration = now()->addSeconds(10);
            $request->session()->put('error', $message_content, $expiration);
            return back();
        }
    }
}
