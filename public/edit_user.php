<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = new mysqli("localhost", "username", "password", "database");

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Τα στοιχεία ενημερώθηκαν επιτυχώς.";
    } else {
        echo "Σφάλμα: " . $conn->error;
    }
}
$conn->close();
?>