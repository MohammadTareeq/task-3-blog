
<?php
require_once __DIR__ . '/../includes/config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if ($username === '' || strlen($username) < 3) $errors[] = 'Username must be at least 3 characters.';
    if ($password === '' || strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';
    if ($password !== $confirm) $errors[] = 'Passwords do not match.';

    if (!$errors) {
        $pdo = get_pdo();
        // Check if username exists
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $errors[] = 'Username already taken.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, $hash]);
            header('Location: login.php?msg=Registered+successfully,+please+login');
            exit;
        }
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h1 class="h4 mb-3">Register</h1>
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
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm" class="form-control" required>
          </div>
          <button class="btn btn-primary" type="submit">Create account</button>
        </form>
        <p class="mt-3 mb-0"><small>Already have an account? <a href="login.php">Login</a></small></p>
      </div>
    </div>
  </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
