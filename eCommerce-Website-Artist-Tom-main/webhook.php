<?php

require __DIR__ . '/vendor/autoload.php';


// Set your Stripe secret key
$stripe_secret_key = "sk_test_51QGJWiDvxdVhiCq9bfHLRHErYVYIBYZOC4XreKcF8EGYmXz2y1QihdKTd7PGYEofrhrnsLO89cwo5UMtSy1J2mf000HPecedn9";
\Stripe\Stripe::setApiKey($stripe_secret_key);

// For webhook security (set your webhook signing secret from Stripe Dashboard)
$endpoint_secret = 'whsec_11eb64e454b8e84c17b46798f927ac9beb7b00ac16d274dfa3962de85daa79b4';

// Retrieve the request payload
$payload = @file_get_contents('php://input');

// Check if the Stripe signature header is set
$sig_header = isset($_SERVER['HTTP_STRIPE_SIGNATURE']) ? $_SERVER['HTTP_STRIPE_SIGNATURE'] : null;

if (!$sig_header) {
    http_response_code(400);
    echo "Error: Missing Stripe Signature Header.";
    exit();
}

try {
    // Verify the webhook signature
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch (\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    echo "Error: Invalid payload.";
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    echo "Error: Invalid signature.";
    exit();
}

// Handle the event
if ($event->type === 'checkout.session.completed') {
    $session = $event->data->object; // Contains the checkout session data

    // Process successful payment
    if ($session->payment_status === 'paid') {
        // Set the payment status in session
        $_SESSION['payment_status'] = 'success';
        include("includes/order.inc.php");

        // You can also save order details to the database here if needed
        // For example:
        // $customer_ID = $_SESSION['userid'];
        // $orderTotal = $_SESSION['totalCost'];
        // Process the order (e.g., save to database)

        // Send response
        http_response_code(200);
        echo json_encode(['status' => 'payment processed']);
        exit;
    }
}

// Default response for other event types
http_response_code(200);
echo "Event type not handled.";
