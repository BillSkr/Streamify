<?php
session_start();
require_once '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO users (firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)');
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->execute([$_POST['firstname'], $_POST['lastname'], $_POST['username'], $hash, $_POST['email']]);
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="post">
        <input name="firstname" placeholder="First Name" required><br>
        <input name="lastname" placeholder="Last Name" required><br>
        <input name="username" placeholder="Username" required><br>
        <input name="password" type="password" placeholder="Password" required><br>
        <input name="email" type="email" placeholder="Email" required><br>
        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
