<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
$pdo = get_pdo();
$user = current_user($pdo);

// Pagination setup
$limit = 5; // posts per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search setup
$search = trim($_GET['search'] ?? '');
$where = '';
$params = [];

if ($search !== '') {
    $where = "WHERE p.title LIKE ? OR p.content LIKE ?";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// Count total posts
$countQuery = "SELECT COUNT(*) FROM posts p $where";
$stmt = $pdo->prepare($countQuery);
$stmt->execute($params);
$total_posts = (int) $stmt->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// Fetch posts
$query = "SELECT p.id, p.title, p.content, p.created_at, u.username
          FROM posts p
          LEFT JOIN users u ON p.user_id = u.id
          $where
          ORDER BY p.created_at DESC
          LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$posts = $stmt->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">All Posts</h1>
    <?php if ($user): ?>
      <a class="btn btn-primary" href="create_post.php">Create Post</a>
    <?php endif; ?>
  </div>

  <!-- Search Form -->
  <form method="get" class="mb-4">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search posts..." 
             value="<?php echo e($search); ?>">
      <button class="btn btn-outline-light" type="submit">Search</button>
    </div>
  </form>

  <?php if (!$posts): ?>
    <div class="alert">No posts found.</div>
  <?php else: ?>
    <div class="row g-3">
      <?php foreach ($posts as $post): ?>
        <div class="col-md-6">
          <div class="card p-3 h-100">
            <h2 class="h5"><?php echo e($post['title']); ?></h2>
            <p class="mb-2 text-muted">
              <small>By <?php echo e($post['username'] ?? 'Unknown'); ?> • <?php echo e($post['created_at']); ?></small>
            </p>
            <p><?php echo nl2br(e(substr($post['content'], 0, 200))); ?><?php if (strlen($post['content']) > 200) echo '...'; ?></p>
            <div class="mt-auto d-flex gap-2">
              <?php if ($user && $post['username'] === $user['username']): ?>
                <a class="btn btn-sm btn-outline-light" href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a>
                <a class="btn btn-sm btn-outline-danger" href="delete_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Delete this post?');">Delete</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <nav class="mt-4">
      <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
          <li class="page-item"><a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page - 1; ?>">Previous</a></li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
            <a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
          <li class="page-item"><a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page + 1; ?>">Next</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  <?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>
