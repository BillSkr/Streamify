<?php
require_once 'conndb.php'; // Include external DB connection file

$stm = $pdo->prepare(
    "INSERT INTO users (first_name, last_name, email, password_hash)
    VALUES (?, ?, ?, ?, ?)"
);

$hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
$stmt->execute([$_POST['name'], $_POST['surname'], $_POST['username'], $_POST['email'], $hash]);
?>

