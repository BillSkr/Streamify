<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../src/youtube.php';
$youtube = new YouTube();
$client = $youtube->getClient();
if (!isset($_GET['code'])) {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit;
}
$accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$_SESSION['access_token'] = $accessToken;
header('Location: create_list.php');
exit;
?>