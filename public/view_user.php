<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = new mysqli("localhost", "username", "password", "database");

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Όνομα: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
    }
} else {
    echo "Δεν βρέθηκαν στοιχεία χρήστη.";
}
$conn->close();
?>