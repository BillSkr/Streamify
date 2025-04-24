<?php
require_once 'conndb.php';
session_start();

$message = "";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. Παίρνεις το username αντί για email
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 2. Ψάχνεις με το username στο WHERE
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // 3. Δέσμευση του hashed password
        $stmt->bind_result($db_hash);
        $stmt->fetch();

        // 4. Έλεγξε με password_verify αν ταιριάζει
        if (password_verify($password, $db_hash)) {
            // 5. Επιτυχής σύνδεση
            $_SESSION['username'] = $username;
            header("Location: dashboard.html");
            exit();
        } else {
            $message = "Incorrect password";
            $toastClass = "bg-danger";
        }
    } else {
        $message = "Username not found";
        $toastClass = "bg-warning";
    }

    $stmt->close();
    $conn->close();
}
?>