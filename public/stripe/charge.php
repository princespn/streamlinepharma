<?php
require  'vendor/autoload.php';
$stripe = new \Stripe\StripeClient('sk_test_51LcyoIBKiPmjVaQdui1MzlB1nB4Ga2PcmxsafKZEwS6jEmrAzCmeIn3ZMpsZXBxPQDv3tV88c0Pj6we4T4MUbBZU0091ZOdvG0');

$data =$stripe->paymentIntents->create(
    [
      'amount' => 1099,
      'currency' => 'usd',
      'setup_future_usage' => 'off_session',
      'customer' => 'cus_NCScYSkPp4Gyjk',
      'payment_method_types' => ['us_bank_account'],
      'payment_method_options' => [
        'us_bank_account' => [
          'financial_connections' => ['permissions' => ['payment_method', 'balances']],
        ],
      ],
    ]
  );
  var_dump($data);