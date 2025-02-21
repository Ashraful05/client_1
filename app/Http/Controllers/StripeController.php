<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function showForm()
    {
        return view('admin.payment.stripe_payment');
    }
    public function payment(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret_key'));
        $response = \Stripe\Checkout\Session::create([
            'line_items'=>[
                [
                    'price_data'=>[
                        'currency'=>'usd',
                        'product_data'=>[
                            'name'=>'money',
                        ],
                        'unit_amount'=>$request->amount * 100,
                    ],
                    'quantity'=>1,
                ],
            ],
            'mode'=>'payment',
            'success_url'=>route('stripe.success'),
            'cancel_url'=>route('stripe.cancel')
        ]);
//        return $response;
        return redirect()->away($response->url);
    }
    public function success()
    {

    }
    public function cancel()
    {

    }

}
