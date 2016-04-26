<?php

$host=$_SERVER['HTTP_HOST'];
$servername = "localhost";
$username = "root";
$password = "504633";
$dbname = "fabelio_warehouse";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
