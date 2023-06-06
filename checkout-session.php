<?php

require 'vendor/autoload.php';

$stripe = new \Stripe\StripeClient('sk_test_51NFgToSBOfbzqDqufxLhSA2zm4u5ldf719ZWW8vzZAg7hvLwua1H8ZhmfZ5pyWyHxtCipKJsKiLmhlHzkrx684pp006aPNrT6m');

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [[
    'price_data' => [
      'currency' => 'inr',
      'product_data' => [
        'name' => 'T-shirt',
      ],
      'unit_amount' => 200000,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost/stripe/success.html',
  'cancel_url' => 'http://localhost:4242/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>
