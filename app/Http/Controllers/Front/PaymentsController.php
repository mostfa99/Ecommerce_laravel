<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Error;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', [
            'order' => $order,
        ]);
    }
    public function createStripePaymentIntent(Order $order)
    {

        // Create a PaymentIntent with amount and currency

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $order->total,
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        try {
            // Create Payment
            $payment = new Payment();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntent->amount,
                'currency' => $paymentIntent->currency,
                'method' => 'stripe',
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),

            ])->save();
        } catch (QueryException $e) {
            echo $e->getMessage();
            return;
        }

        /*
        // Create a PaymentIntent with amount and currency
        $stripe = new \Stripe\StripeClient(
            config('services.stripe.secret_key')
        );
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $order->total,
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        /*
        $stripe = new \Stripe\PaymentIntent(config('services.stripe.secret_key')));
        $paymentIntent =  $stripe->paymentIntent->create([
            'amount' => $order->total,
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
   */
        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }
    public function confirm(Request $request, Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );
        if ($paymentIntent->status == 'succeeded') {
            try {
                // Update Payment
                $payment = Payment::where('order_id', $order->id)->first();
                $payment->forceFill([
                    'status' => 'completed',
                ])->save();
            } catch (QueryException $e) {
                echo $e->getMessage();
                return;
            }
            event('payment.created', $payment->id);
            return Redirect()->route('home', [
                'status' => 'payment-succeded',
                'transaction_data' => json_encode($paymentIntent),
            ]);
        } //END IF

        return Redirect()->route('order.payments.create', [
            'order_id' => $order->id,
            'status' => $paymentIntent->status,
        ]);
    } //END confirm()
}
