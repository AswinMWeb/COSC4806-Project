<?php if (!$movie): ?>
    <p><strong>Error:</strong> Movie details not found or could not be fetched from OMDB API.</p>
    <a href="index.php">← Back to Search</a>
    <?php exit; ?>
<?php endif; ?>

<?php require __DIR__ . '/../templates/header.php'; ?>

<h1><?= htmlspecialchars($movie['Title'] ?? 'Unknown Title') ?> (<?= htmlspecialchars($movie['Year'] ?? 'N/A') ?>)</h1>

<img src="<?= htmlspecialchars($movie['Poster'] ?? '') ?>" alt="Poster" class="img-thumbnail mb-3" style="max-width:200px;">

<p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre'] ?? 'N/A') ?></p>
<p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot'] ?? 'N/A') ?></p>

<form method="POST" action="index.php?action=rate" class="mb-4">
    <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movie['imdbID'] ?? '') ?>">
    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title'] ?? '') ?>">
    <label for="rating" class="form-label">Rate this movie:</label>
    <select name="rating" id="rating" class="form-select" style="width:100px;">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?>/5</option>
        <?php endfor; ?>
    </select>
    <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
</form>

<?php
$avg = \App\Models\Rating::getAverage($movie['imdbID'] ?? '');
$count = \App\Models\Rating::getCount($movie['imdbID'] ?? '');
?>
<p><strong>Average Rating:</strong> <?= $avg ?>/5 (<?= $count ?> votes)</p>

<form method="POST" action="index.php?action=review" class="mb-3">
    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title'] ?? '') ?>">
    <button type="submit" class="btn btn-info">Get AI Review</button>
</form>

<?php if (!empty($review)): ?>
    <h3>AI Review:</h3>
    <p><?= nl2br(htmlspecialchars($review)) ?></p>
<?php endif; ?>

<a href="index.php" class="btn btn-secondary mt-3">← Back to Search</a>

<?php require __DIR__ . '/../templates/footer.php'; ?>
