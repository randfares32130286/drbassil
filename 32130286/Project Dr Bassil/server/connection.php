<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "oneshop";

$conn = mysqli_connect("$server", "$user", "$pass", "$db")
or die("Connection failed: " . mysqli_connect_error());

?>