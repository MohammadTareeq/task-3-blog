
<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_login();
$pdo = get_pdo();

$errors = [];
$title = '';
$content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '') $errors[] = 'Title is required.';
    if ($content === '') $errors[] = 'Content is required.';

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)');
        $stmt->execute([$_SESSION['user_id'], $title, $content]);
        header('Location: index.php?msg=Post+created');
        exit;
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <h1 class="h4 mb-3">Create Post</h1>
        <?php if ($errors): ?>
          <div class="alert">
            <ul class="mb-0"><?php foreach ($errors as $e): ?><li><?php echo e($e); ?></li><?php endforeach; ?></ul>
          </div>
        <?php endif; ?>
        <form method="post">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo e($title); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" rows="8" class="form-control" required><?php echo e($content); ?></textarea>
          </div>
          <button class="btn btn-primary" type="submit">Save</button>
          <a class="btn btn-secondary" href="index.php">Cancel</a>
        </form>
      </div>
    </div>
  </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
