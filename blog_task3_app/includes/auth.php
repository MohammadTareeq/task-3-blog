
<?php
// includes/auth.php
require_once __DIR__ . '/config.php';

function require_login(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php?msg=Please+login');
        exit;
    }
}

function current_user(PDO $pdo): ?array {
    if (empty($_SESSION['user_id'])) return null;
    $stmt = $pdo->prepare('SELECT id, username, created_at FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    return $user ?: null;
}
?>
