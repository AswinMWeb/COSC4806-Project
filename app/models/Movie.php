<?php
class Movie extends Model {
    public function search($title) {
        $url = "http://www.omdbapi.com/?apikey=" . OMDB_API_KEY . "&s=" . urlencode($title);
        echo $url;

        return json_decode(file_get_contents($url), true);
    }

    public function getOrCreateByImdb($imdbID) {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE imdb_id = ?");
        $stmt->execute([$imdbID]);
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($movie) return $movie;

        $url = "http://www.omdbapi.com/?apikey=" . OMDB_API_KEY . "&i=$imdbID&plot=full";
        $data = json_decode(file_get_contents($url), true);

        $stmt = $this->db->prepare("INSERT INTO movies (imdb_id, title, year, poster, data) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$imdbID, $data['Title'], $data['Year'], $data['Poster'], json_encode($data)]);

        return $this->getOrCreateByImdb($imdbID);
    }
}
