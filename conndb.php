<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";  
$dbname = "form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8"); // Optional: ensure UTF-8
?>
