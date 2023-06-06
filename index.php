<?php

require_once('vendor/autoload.php');

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient('');

try {
    $session = $stripe->checkout->sessions->create([
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => ['name' => 'T-shirt'],
                    'unit_amount' => 200000, // 2000 INR = 200000 paise (smallest currency unit in INR)
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => 'http://localhost/stripe/success.html',
        'cancel_url' => 'http://localhost:4242/cancel.html',
    ]);

    // Redirect the user to the Checkout page
    header("Location: " . $session->url);
    exit;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle error
    echo 'Error: ' . $e->getMessage();
}
