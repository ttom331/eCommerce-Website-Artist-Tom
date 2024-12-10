<?php

session_start();
require __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve the Stripe secret key 
$stripe_secret_key = $_ENV['STRIPE_SECRET_KEY'];

\Stripe\Stripe::setApiKey($stripe_secret_key);


if (isset($_POST['submitorder'])){
    $_SESSION['customeridorder'] = $_SESSION['userid'];
    $_SESSION['address1order'] = $_POST['addressline1'];
    $_SESSION['address2order'] = $_POST['addressline2'];
    $_SESSION['townorder'] = $_POST['town'];
    $_SESSION['postcodeorder'] = $_POST['postcode'];
    $_SESSION['totalCostorder'] = $_SESSION['totalCost2'];
    $orderStatus = "hello";
    
}

include('classes/getBasketitems.php');
if (isset($basket) && $basket) {
    $line_items = [];
    $totalCost = 0;

    $discount = isset($_SESSION['discount']) ? $_SESSION['discount'] : 0;

    foreach ($basket as $row) {
        $price = $row['print_Price'] * 100; // Price in pence
        $quantity = htmlspecialchars($row['quantity']);
        
        // Calculate the discounted price
        $discountedPrice = $price - ($price * ($discount / 100));
        
        $line_items[] = [
            "quantity" => htmlspecialchars($row['quantity']),
            "price_data" => [
                "currency" => "gbp",
                "unit_amount" => round($discountedPrice), // Ensure to round the amount
                "product_data" => [
                    "name" => htmlspecialchars($row['print_Name']),
                ],
            ],
        ];

        // Accumulate total cost for display or further processing
        $totalCost += round($discountedPrice) * $quantity;
    }

    $_SESSION['totalCost'] = $totalCost;

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost:3000/success.php?session_id={CHECKOUT_SESSION_ID}", // add sessionid
        "cancel_url" => "http://localhost:3000/basket.php", 
        "line_items" => $line_items,
    ]);
    

    http_response_code(303);
    header("Location: " . $checkout_session->url);
}

