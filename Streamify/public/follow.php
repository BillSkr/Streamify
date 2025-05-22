<?php
session_start();
require_once '../src/db.php';
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
$follower = $_SESSION['user']['id'];
$followee = $_GET['user_id'];
if ($_GET['action'] === 'follow') {
    $stmt = $pdo->prepare('INSERT IGNORE INTO follows (follower, followee) VALUES (?, ?)');
    $stmt->execute([$follower, $followee]);
} else {
    $stmt = $pdo->prepare('DELETE FROM follows WHERE follower=? AND followee=?');
    $stmt->execute([$follower, $followee]);
}
header('Location: profile.php?id='.$followee);
exit;
?>