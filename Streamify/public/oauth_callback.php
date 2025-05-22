<?php
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