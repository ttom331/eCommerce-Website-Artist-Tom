<?php



class Order extends Dbh {

    protected function addOrder($customer_ID, $address1, $address2, $town, $postcode, $orderTotal, $orderStatus, $orderDate) {
        
        // Get the connection once
        $conn = $this->connect();
        $stmt = $conn->prepare('INSERT INTO orders (user_id, order_total, order_status, order_address1, order_address2, town, postcode, order_Date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');

        if ($stmt->execute(array($customer_ID, $orderTotal, $orderStatus, $address1, $address2, $town, $postcode, $orderDate))) {
            // Use lastInsertId on the same connection instance
            $orderID = $conn->lastInsertId();
        } else {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed1");
            exit();
        }

        // Pass the connection to addItems
        $this->addItems($conn, $orderID, $customer_ID);

        return $orderID;
    }

    protected function addItems($conn, $order_ID, $customer_ID) {

        include('classes/getBasketitemsOrder.php');
        
        if (isset($basket1) && $basket1) {
            foreach ($basket1 as $row) {
                $stmt = $conn->prepare('INSERT INTO order_items (user_id, order_ID, print_ID, print_Name, print_Price, quantity, print_Image) VALUES (?, ?, ?, ?, ?, ?, ?);');

                if (!$stmt->execute(array($customer_ID, $order_ID, $row['print_ID'], $row['print_Name'], $row['print_Price'], $row['quantity'], $row['print_Image']))) {
                    $stmt = null;
                    header("location: ../index.php?error=stmtfailed1");
                    exit();
                }
            }
        }
    }
}
