<?php
session_start();
require_once '../src/db.php';
require_once '../src/youtube.php';
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
$youtube = new YouTube();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $videoId = $_POST['video_id'];
    $title = $_POST['video_title'];
    $listId = $_POST['list_id'];
    $stmt = $pdo->prepare('INSERT INTO videos (list_id, title, video_id, added_by) VALUES (?, ?, ?, ?)');
    $stmt->execute([$listId, $title, $videoId, $_SESSION['user']['id']]);
    header("Location: view_list.php?id={$listId}");
    exit;
} elseif (isset($_GET['q'])) {
    $results = $youtube->search($_GET['q']);
}
?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head><meta charset="UTF-8"><title>Add Video</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Add Video to List</h2>
    <form method="get">
        <input name="q" placeholder="Search YouTube" required>
        <button type="submit">Search</button>
    </form>
    <?php if (isset($results)): ?>
        <ul>
        <?php foreach ($results['items'] as $item): ?>
            <li>
                <img src="<?= $item['snippet']['thumbnails']['default']['url'] ?>">
                <?= htmlspecialchars($item['snippet']['title']) ?>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="video_id" value="<?= $item['id']['videoId'] ?>">
                    <input type="hidden" name="video_title" value="<?= htmlspecialchars($item['snippet']['title']) ?>">
                    <input type="hidden" name="list_id" value="<?= $_GET['list_id'] ?>">
                    <button type="submit">Add</button>
                </form>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
</body>
</html>
