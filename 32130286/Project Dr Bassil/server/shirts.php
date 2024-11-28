<?php

include("connection.php");

$stmt = $conn->prepare("SELECT * FROM products where product_category='Shirts' LIMIT 4");

$stmt->execute();

$get = $stmt->get_result();

?>