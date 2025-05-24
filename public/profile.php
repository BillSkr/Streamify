<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../src/db.php';
$userId = $_GET['id'] ?? $_SESSION['user']['id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id=?');
$stmt->execute([$userId]);
$user = $stmt->fetch();
if (!$user) exit('User not found');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $stmt = $pdo->prepare('UPDATE users SET firstname=?, lastname=?, email=? WHERE id=?');
    $stmt->execute([$_POST['firstname'], $_POST['lastname'], $_POST['email'], $userId]);
    header('Location: profile.php?id='.$userId);
    exit;
} elseif (isset($_POST['delete'])) {
    if ($userId == $_SESSION['user']['id']) {
        $stmt = $pdo->prepare('DELETE FROM users WHERE id=?');
        $stmt->execute([$userId]);
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
$stmt = $pdo->prepare('SELECT COUNT(*) FROM lists WHERE user_id=?');
$stmt->execute([$userId]);
$listCount = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html class="<?= $_COOKIE['theme'] ?? 'light' ?>">
<head><meta charset="UTF-8"><title>Profile</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Profile: <?= htmlspecialchars($user['username']) ?></h2>
    <form method="post">
        First name: <input name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required><br>
        Last name: <input name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required><br>
        Email: <input name="email" type="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>
        <button name="edit" type="submit">Save Changes</button>
        <?php if ($userId == $_SESSION['user']['id']): ?>
            <button name="delete" type="submit" onclick="return confirm('Are you sure?')">Delete Account</button>
        <?php endif; ?>
    </form>
    <p>Total lists: <?= $listCount ?></p>
    <?php if ($userId != $_SESSION['user']['id']): ?>
        <?php
        $stmt = $pdo->prepare('SELECT 1 FROM follows WHERE follower=? AND followee=?');
        $stmt->execute([$_SESSION['user']['id'],$userId]);
        $isFollowing = $stmt->fetch();
        ?>
        <a href="follow.php?user_id=<?= $userId ?>&action=<?= $isFollowing ? 'unfollow' : 'follow' ?>">
            <?= $isFollowing ? 'Unfollow' : 'Follow' ?>
        </a>
    <?php endif; ?>
</div>
</body>
</html>
