<?php require __DIR__ . '/../templates/header.php'; ?>

<div class="container">
  <h2 class="mb-4 text-center">Login</h2>
  <form method="POST" class="w-50 mx-auto">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>

  <?php if (!empty($error)) : ?>
    <div class="alert alert-danger mt-3 w-50 mx-auto"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <div class="text-center mt-3">
    <a href="?action=register">Register</a> | 
    <a href="?action=guest">Continue as Guest</a>
  </div>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
