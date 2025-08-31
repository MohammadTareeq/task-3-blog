
<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_login();
$pdo = get_pdo();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT user_id FROM posts WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch();

if (!$row) {
    header('Location: index.php?msg=Post+not+found');
    exit;
}

// Only owner can delete
if ((int)$row['user_id'] !== (int)$_SESSION['user_id']) {
    header('Location: index.php?msg=Not+authorized');
    exit;
}

$del = $pdo->prepare('DELETE FROM posts WHERE id = ?');
$del->execute([$id]);
header('Location: index.php?msg=Post+deleted');
exit;
