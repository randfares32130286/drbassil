<?php

include("connection.php");

$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();

$get = $stmt->get_result();

?>