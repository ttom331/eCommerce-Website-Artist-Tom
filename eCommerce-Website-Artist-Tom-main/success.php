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

// Check if the session ID is present in the query parameters
if (!isset($_GET['session_id'])) {
    die("Session ID is missing from the URL.");
}


$sessionId = $_GET['session_id'];

try {
    // Retrieve the checkout session
    $checkout_session = \Stripe\Checkout\Session::retrieve($sessionId);

    // Verify the payment status
    if ($checkout_session->payment_status === 'paid') {
        // Retrieve customer information
        $customerEmail = $checkout_session->customer_email;

        // Retrieve line items associated with the checkout session
        $line_items = \Stripe\Checkout\Session::allLineItems($sessionId);

        include_once "classes/dbh.classes.php";
        include "classes/order.classes.php";
        include "classes/order-contr.classes.php";

        $customer_ID = $_SESSION['customeridorder'];
        $address1 = $_SESSION['address1order']; 
        $address2 = $_SESSION['address2order']; 
        $town = $_SESSION['townorder'];
        $postcode = $_SESSION['postcodeorder'];
        $orderTotal = $_SESSION['totalCostorder'];
        $orderStatus = "Paid";
        $orderDate = date('Y-m-d H:i:s');
        


        $order = new OrderContr($customer_ID, $address1, $address2, $town, $postcode, $orderTotal, $orderStatus, $orderDate); //create object from the logincontr class


        $order->addToOrder();
        






        include 'classes/remove-from-basket.classes.php';
        header("Location: account.php");
    } else {
        echo "Payment was not successful. Please try again.";
    }
} catch (\Exception $e) {
    // Handles errors from Stripe
    die("Error: " . $e->getMessage());
}

