<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../src/db.php';
header('Content-Type: text/yaml');
require 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

$stmt = $pdo->prepare('SELECT l.id, l.title, l.created_at, u.username, v.title as video_title, v.video_id FROM lists l JOIN users u ON l.user_id=u.id JOIN videos v ON v.list_id=l.id WHERE l.is_public=1 ORDER BY l.id, v.added_at');
$stmt->execute();
$data = [];
foreach ($stmt->fetchAll() as $row) {
    $lid = $row['id'];
    if (!isset($data[$lid])) {
        $data[$lid] = [
            'title' => $row['title'],
            'created_at' => $row['created_at'],
            'username' => hash('sha256', $row['username']),
            'videos' => []
        ];
    }
    $data[$lid]['videos'][] = ['title' => $row['video_title'], 'id' => $row['video_id']];
}
echo Yaml::dump($data);
?>