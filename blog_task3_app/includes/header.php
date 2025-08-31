
<?php
// includes/header.php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth.php';  // ✅ Add this line

$pdo = get_pdo();
$user = current_user($pdo);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - Task 2</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">My Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if ($user): ?>
          <li class="nav-item"><span class="navbar-text me-3">👋 <?php echo e($user['username']); ?></span></li>
          <li class="nav-item"><a class="nav-link" href="create_post.php">✍️ New Post</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">🚪 Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="register.php">🆕 Register</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">🔑 Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

    <main class="container my-4">
