<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TwintController extends Controller
{
    public function showPaymentForm()
    {
        return view('twint.payment');
    }

    public function processPayment(Request $request)
    {
        $client = new Client();

        // TWINT API URL (replace with the actual endpoint)
        $url = 'https://api.twint.ch/v1/payments';

        // API credentials
        $apiKey = env('TWINT_API_KEY');

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'amount' => $request->amount,
                    'currency' => 'CHF',
                    'reference' => 'order_' . time(),
                    'successUrl' => route('twint.success'),
                    'failureUrl' => route('twint.failure'),
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['status'] === 'created') {
                return redirect($data['paymentLink']);
            } else {
                return back()->with('error', 'Payment could not be initiated.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        return view('twint.success');
    }

    public function failure()
    {
        return view('twint.failure');
    }
}
