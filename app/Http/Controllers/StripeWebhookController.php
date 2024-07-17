<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    public function show()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51Pd8PgBp68NP3WCI17AKodrNUA2PaYx3nu9phTE71DgvdmKsQ8cAPMpStfzeg6ByDL0QUWbn03TKdiiVz5orxNVx00gW8VrV0r');

        // Create dynamic product

        $CreateProduct = $stripe->products->create([
            'name' => 'Test product',
        ]);


        // Set price to product Id

        $PriceId = $stripe->prices->create([
            'currency' => 'USD',
            'unit_amount' => 2005,
            'product' => $CreateProduct->id,
        ]);


        // Create Link

        $paymentLink = $stripe->paymentLinks->create([
            'line_items' => [
                [
                    'price' => $PriceId->id,
                    'quantity' => 1,
                ],
            ],
            'metadata' => [
                'invoiceId' => 276356,
            ],
            'after_completion' => [
                'type' => 'redirect',
                'redirect' => ['url' => 'http://localhost/strip?checkout_session_id={CHECKOUT_SESSION_ID}'],
            ],
        ]);

    
    }

}
