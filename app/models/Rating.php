<?php
class Rating extends Model {
    public function add($movieId, $score) {
        $stmt = $this->db->prepare("INSERT INTO ratings (movie_id, rating) VALUES (?, ?)");
        $stmt->execute([$movieId, $score]);
    }

    public function average($movieId) {
        $stmt = $this->db->prepare("SELECT AVG(rating) as avg FROM ratings WHERE movie_id = ?");
        $stmt->execute([$movieId]);
        return round($stmt->fetch()['avg'] ?? 0, 1);
    }
}
