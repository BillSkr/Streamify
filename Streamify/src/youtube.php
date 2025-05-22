<?php
require_once 'db.php';
session_start();

class YouTube {
    private $apiKey;
    private $clientId;
    private $clientSecret;
    private $redirectUri;

    public function __construct() {
        $this->apiKey = getenv('YOUTUBE_API_KEY');
        $this->clientId = getenv('YOUTUBE_CLIENT_ID');
        $this->clientSecret = getenv('YOUTUBE_CLIENT_SECRET');
        $this->redirectUri = 'http://' . $_SERVER['HTTP_HOST'] . '/public/oauth_callback.php';
    }

    public function getClient() {
        $client = new Google_Client();
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        $client->addScope('https://www.googleapis.com/auth/youtube.readonly');
        return $client;
    }

    public function search($query) {
        $url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=10&q=' . urlencode($query) . '&key=' . $this->apiKey;
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}
?>