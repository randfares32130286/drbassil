<?php

include("connection.php");

$stmt = $conn->prepare("SELECT * FROM products");

$stmt->execute();

$get = $stmt->get_result();

?>