<?php
session_start();
?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="help.php">Help</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="profile.php">Profile</a>
        <a href="lists.php">My Lists</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    <?php endif; ?>
    <button id="theme-toggle">Toggle Theme</button>
</div>
<div class="container">
    <h1>Welcome to Streaming App</h1>
    <p>Create and share your own YouTube video playlists.</p>
</div>
<script src="js/main.js"></script>
</body>
</html>
