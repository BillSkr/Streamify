<?php
// form_insertion.php

// 1. Load the MySQLi connection
require_once 'conndb.php';

// 2. Grab & validate/sanitize input
$first    = $_POST['name']     ?? '';
$last     = $_POST['surname']  ?? '';
$user     = $_POST['username'] ?? '';
$email    = $_POST['email']    ?? '';
$password = $_POST['password'] ?? '';

if (! $first || ! $last || ! $user || ! $email || ! $password) {
    die('All fields are required.');
}

// 3. Hash the password
$hash = password_hash($password, PASSWORD_BCRYPT);

// 4. Prepare your INSERT (5 columns → 5 placeholders)
$stmt = $conn->prepare("
  INSERT INTO users 
    (first_name, last_name, username, email, password_hash)
  VALUES (?,       ?,         ?,        ?,     ?)
");
if (! $stmt) {
    die('Prepare failed: ' . $conn->error);
}

// 5. Bind parameters: five strings
$stmt->bind_param('sssss',
  $first,
  $last,
  $user,
  $email,
  $hash
);

// 6. Execute & check
if ($stmt->execute()) {
    echo 'Registration successful!';
} else {
    echo 'Execute failed: ' . $stmt->error;
}

// 7. Clean up
$stmt->close();
$conn->close();
