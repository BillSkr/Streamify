<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../src/db.php';
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO lists (user_id, title, is_public) VALUES (?, ?, ?)');
    $stmt->execute([$_SESSION['user']['id'], $_POST['title'], $_POST['is_public']]);
    header('Location: lists.php');
    exit;
}
?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head><meta charset="UTF-8"><title>Create List</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Create New List</h2>
    <form method="post">
        <input name="title" placeholder="List Title" required><br>
        <label><input type="checkbox" name="is_public" value="1" checked> Public</label><br>
        <button type="submit">Create</button>
    </form>
</div>
</body>
</html>
