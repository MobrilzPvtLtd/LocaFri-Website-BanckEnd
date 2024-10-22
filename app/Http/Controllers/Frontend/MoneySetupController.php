<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;

class MoneySetupController extends Controller
{
    public function paymentStripe()
    {
        return view('frontend.stripe');
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required|integer|min:1|max:12',
            'ccExpiryYear' => 'required|integer|min:' . date('Y'),
            'cvvNumber' => 'required|digits:3',
        ]);

        if ($validator->fails()) {
            return redirect()->route('addmoney.paystripe')
                ->withErrors($validator)
                ->withInput();
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $token = \Stripe\Token::create([
                'card' => [
                    'number' => $request->card_no,
                    'exp_month' => $request->ccExpiryMonth,
                    'exp_year' => $request->ccExpiryYear,
                    'cvc' => $request->cvvNumber,
                ],
            ]);

            if (!isset($token['id'])) {
                return redirect()->route('addmoney.paystripe')->with('error', 'Stripe token generation failed');
            }

            $charge = \Stripe\Charge::create([
                'amount' => 2049, // Amount in cents
                'currency' => 'usd',
                'description' => 'Wallet payment',
                'source' => $token['id'],
            ]);

            if ($charge['status'] == 'succeeded') {
                return redirect()->route('addmoney.paystripe')->with('success', 'Payment successful!');
            } else {
                return redirect()->route('addmoney.paystripe')->with('error', 'Payment failed!');
            }

        } catch (CardException $e) {
            return redirect()->route('addmoney.paystripe')->with('error', $e->getMessage());
        } catch (InvalidRequestException $e) {
            return redirect()->route('addmoney.paystripe')->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('addmoney.paystripe')->with('error', 'An error occurred, please try again.');
        }
    }
}
