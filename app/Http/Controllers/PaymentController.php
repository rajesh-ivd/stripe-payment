<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{

    public function index()
    {
        return view('index', ['showSuccessModal' => false, 'showFailureModal' => false]);
    }

    public function handlePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'payment_method_types' => ['card'],
                'amount' => 1000,
                'currency' => 'usd',
                'description' => 'IVDISPLAYS DIGITAL SERVICES PVT LTD',
            ]);

            return view('index', [
                'clientSecret' => $paymentIntent->client_secret,
                'showSuccessModal' => true,
                'showFailureModal' => false,
            ]);
        } catch (\Exception $e) {
            return view('index', [
                'clientSecret' => '',
                'showSuccessModal' => false,
                'showFailureModal' => true,
            ]);
        }
    }

}
