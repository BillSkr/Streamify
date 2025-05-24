<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../src/db.php';
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
$query = $_GET['q'] ?? '';
$params = [];
$sql = 'SELECT l.*, u.username, u.firstname, u.lastname FROM lists l JOIN users u ON l.user_id=u.id WHERE l.is_public=1';
if ($query) {
    $sql .= ' AND (l.title LIKE ? OR u.username LIKE ? OR u.firstname LIKE ? OR u.lastname LIKE ?)';
    for ($i = 0; $i < 4; $i++) $params[] = "%{$query}%";
}
$sql .= ' ORDER BY l.created_at DESC';
// pagination
$page = max(1, (int)($_GET['page'] ?? 1));
$per = 10;
$offset = ($page-1)*$per;
$sql .= ' LIMIT ?,?';
$params[] = $offset;
$params[] = $per;
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$lists = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head><meta charset="UTF-8"><title>Search</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Search Public Lists</h2>
    <form><input name="q" placeholder="Search..." value="<?= htmlspecialchars($query) ?>"><button>Search</button></form>
    <?php foreach ($lists as $list): ?>
        <div>
            <h3><a href="view_list.php?id=<?= $list['id'] ?>"><?= htmlspecialchars($list['title']) ?></a></h3>
            by <?= htmlspecialchars($list['username']) ?>
        </div>
    <?php endforeach; ?>
    <div>
        <?php if ($page>1): ?><a href="?q=<?= urlencode($query) ?>&page=<?= $page-1 ?>">Prev</a><?php endif; ?>
        <span>Page <?= $page ?></span>
        <a href="?q=<?= urlencode($query) ?>&page=<?= $page+1 ?>">Next</a>
    </div>
</div>
</body>
</html>
