
<?php
require_once __DIR__ . '/../includes/config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') $errors[] = 'Username and password are required.';

    if (!$errors) {
        $pdo = get_pdo();
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php?msg=Welcome+' . urlencode($user['username']));
            exit;
        } else {
            $errors[] = 'Invalid credentials.';
        }
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h1 class="h4 mb-3">Login</h1>
        <?php if (isset($_GET['msg'])): ?><div class="alert"><?php echo e($_GET['msg']); ?></div><?php endif; ?>
        <?php if ($errors): ?>
          <div class="alert">
            <ul class="mb-0">
              <?php foreach ($errors as $e): ?><li><?php echo e($e); ?></li><?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <form method="post">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary" type="submit">Login</button>
        </form>
        <p class="mt-3 mb-0"><small>No account? <a href="register.php">Register</a></small></p>
      </div>
    </div>
  </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
