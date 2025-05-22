<?php session_start(); ?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head>
    <meta charset="UTF-8">
    <title>Help</title>
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
    <h2 class="accordion">Purpose & Signup</h2>
    <div class="accordion-content">
        <p>This app lets you register and create playlists of YouTube videos.</p>
    </div>
    <h2 class="accordion">How to Use</h2>
    <div class="accordion-content">
        <ol>
            <li>Register an account</li>
            <li>Create lists (public or private)</li>
            <li>Search YouTube and add videos</li>
            <li>Share and follow users</li>
        </ol>
    </div>
</div>
<script src="js/main.js"></script>
</body>
</html>
