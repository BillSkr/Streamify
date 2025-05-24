<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../src/db.php';
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
$stmt = $pdo->prepare('SELECT * FROM lists WHERE id = ?');
$stmt->execute([$_GET['id']]);
$list = $stmt->fetch();
if (!$list || (!$list['is_public'] && $list['user_id'] != $_SESSION['user']['id'])) {
    die('Unauthorized');
}
$stmt = $pdo->prepare('SELECT * FROM videos WHERE list_id = ? ORDER BY added_at DESC');
$stmt->execute([$_GET['id']]);
$videos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head><meta charset="UTF-8"><title><?= htmlspecialchars($list['title']) ?></title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2><?= htmlspecialchars($list['title']) ?></h2>
    <?php foreach ($videos as $video): ?>
        <div>
            <h3><?= htmlspecialchars($video['title']) ?></h3>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $video['video_id'] ?>" frameborder="0" allowfullscreen></iframe>
            <?php if ($video['added_by'] == $_SESSION['user']['id']): ?>
                <a href="delete_video.php?id=<?= $video['id'] ?>&list_id=<?= $_GET['id'] ?>">Delete</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <a href="add_video.php?list_id=<?= $_GET['id'] ?>">Add Video</a>
</div>
</body>
</html>
