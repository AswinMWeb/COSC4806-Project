<?php if (!$movie): ?>
    <div class="container mt-5">
        <div class="alert alert-danger text-center">
            <strong>Error:</strong> Movie details not found or could not be fetched from OMDB API.
        </div>
        <div class="text-center">
            <a href="index.php" class="btn btn-secondary">← Back to Search</a>
        </div>
    </div>
    <?php exit; ?>
<?php endif; ?>

<?php require __DIR__ . '/../templates/header.php'; ?>

<div class="container my-5">
    
    <div class="bg-gradient p-4 text-white rounded shadow mb-4" style="background: linear-gradient(135deg, #4e73df, #1cc88a);">
        <h2 class="mb-0"><?= htmlspecialchars($movie['Title'] ?? 'Unknown Title') ?></h2>
        <span class="badge bg-dark mt-2"><?= htmlspecialchars($movie['Year'] ?? 'N/A') ?></span>
        <span class="badge bg-secondary ms-2"><?= htmlspecialchars($movie['Genre'] ?? 'N/A') ?></span>
    </div>

    
    <div class="row g-4">
        
        <div class="col-md-4 text-center">
            <img src="<?= htmlspecialchars($movie['Poster'] ?? '') ?>" alt="Poster" class="img-fluid rounded shadow-sm mb-3">
        </div>

        
        <div class="col-md-8">
            
            <div class="mb-4">
                <h5 class="mb-2">Plot</h5>
                <p class="text-muted"><?= htmlspecialchars($movie['Plot'] ?? 'N/A') ?></p>
            </div>

            
            <div class="mb-4">
                <form method="POST" action="index.php?action=rate" class="d-flex flex-column flex-sm-row align-items-sm-end gap-3">
                    <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movie['imdbID'] ?? '') ?>">
                    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title'] ?? '') ?>">

                    <div>
                        <label for="rating" class="form-label mb-1">Your Rating:</label>
                        <select name="rating" id="rating" class="form-select w-auto">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?>/5</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                </form>
                <?php
                $avg = \App\Models\Rating::getAverage($movie['imdbID'] ?? '');
                $count = \App\Models\Rating::getCount($movie['imdbID'] ?? '');
                ?>
                <p class="mt-2"><strong>Average Rating:</strong> <?= $avg ?>/5 (<?= $count ?> votes)</p>
            </div>

            
            <div class="mb-4">
                <form method="POST" action="index.php?action=review">
                    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title'] ?? '') ?>">
                    <button type="submit" class="btn btn-outline-info">Generate AI Review</button>
                </form>
            </div>

            
            <?php if (!empty($review)): ?>
                <div class="p-3 bg-light border rounded">
                    <h5>AI Review:</h5>
                    <p><?= nl2br(htmlspecialchars($review)) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

   
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-secondary">← Back to Search</a>
    </div>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
