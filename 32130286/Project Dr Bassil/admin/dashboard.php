<?php
session_start();
include('../server/connection.php');


$stmtProducts = $conn->prepare("SELECT * FROM products");
$stmtProducts->execute();
$products = $stmtProducts->get_result();

$stmtOrders = $conn->prepare("SELECT orders.order_id, orders.order_cost, users.user_name FROM orders
    JOIN users ON orders.user_id = users.user_id");
$stmtOrders->execute();
$orders = $stmtOrders->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>One Admin Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
</head>
<body>

<?php include 'layouts/navbar.php'; ?>

<div class="container mt-5">
    <h2>Products</h2>
    <h3 class="text-success"><?php if(isset($_GET['message'])) { echo $_GET['message']; } ?></h3>
    <h3 class="text-danger"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['product_id'] ?></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['product_price'] ?></td>
                <td><a class="text-decoration-none" href="edit_product.php?id=<?= $product['product_id'] ?>">Edit</a></td>
                <td><a class="text-danger text-decoration-none" href="remove_product.php?id=<?= $product['product_id'] ?>" onclick="return confirm('Are you sure you want to remove this product?')">Remove</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
        <h2>Add Product</h2>
        <form action="add_product.php" method="post">
            <button type="submit" class="btn btn-primary mb-5 mt-3">Add Product</button>
        </form>

        <h2>Orders</h2>
        <form action="clear_orders.php" method="post" onsubmit="return confirm('Are you sure you want to clear all orders?')">
            <button type="submit" name="clear_orders" class="btn btn-danger mb-3 mt-3">Clear Orders</button>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Order Cost</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= $order['user_name'] ?></td>
                    <td><?= $order['order_cost'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>

</body>
</html>
