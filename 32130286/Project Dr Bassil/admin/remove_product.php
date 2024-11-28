<?php
session_start();
include('../server/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $stmtRemoveProduct = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmtRemoveProduct->bind_param("i", $productId);

    if ($stmtRemoveProduct->execute()) {
        header ("location: dashboard.php?message=Product Removed");
    } else {
        header ("location: dashboard.php?error=Something Went Wrong");
    }

    $stmtRemoveProduct->close();
}
exit();
?>
