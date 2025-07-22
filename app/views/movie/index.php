<?php require __DIR__ . '/../templates/header.php'; ?>

<h1 class="mb-4 text-center">Search for a Movie</h1>
<form action="index.php" method="GET" class="d-flex gap-2">
  <input type="hidden" name="action" value="search">
  <input
    type="text"
    name="title"
    class="form-control"
    placeholder="Enter movie title"
    required
    autofocus
  >
  <button type="submit" class="btn btn-primary">Search</button>
</form>

<?php require __DIR__ . '/../templates/footer.php'; ?>
