<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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