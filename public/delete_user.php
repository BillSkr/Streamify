<?php
$conn = new mysqli("localhost", "username", "password", "database");

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

$user_id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = $user_id";
if ($conn->query($sql) === TRUE) {
    echo "Το προφίλ διαγράφηκε επιτυχώς.";
} else {
    echo "Σφάλμα: " . $conn->error;
}
$conn->close();
?>