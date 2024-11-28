<?php
session_start();
include('connection.php');

if (isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, user_id, user_address, order_date) VALUES (?, ?, ?, ?);");
    $stmt->bind_param("iiss", $order_cost, $user_id, $address, $order_date);
    $stmt->execute();

    $order_id = $stmt->insert_id;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
         
        $product_order_id = $order_id;

        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");

        $stmt1->bind_param("iisssiii", $product_order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }

    unset($_SESSION['cart']);
  
    
    header('location: ../payment.php?order_id=' . $order_id);

}
?>
