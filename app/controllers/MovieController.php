<?php
class MovieController extends Controller {
    public function search() {
        $model = new Movie();
        $results = [];

        if (!empty($_GET['q'])) {
            $results = $model->search($_GET['q'])['Search'] ?? [];
        }

        $this->view('movie/search', ['results' => $results]);
    }

    public function detail($imdbID) {
        $movieModel = new Movie();
        $ratingModel = new Rating();
        $reviewModel = new Review();

        $movie = $movieModel->getOrCreateByImdb($imdbID);
        $avg = $ratingModel->average($movie['id']);
        $review = $reviewModel->get($movie['id']);

        $this->view('movie/detail', [
            'movie' => json_decode($movie['data'], true),
            'rating' => $avg,
            'review' => $review,
            'id' => $movie['id']
        ]);
    }

    public function rate() {
        $ratingModel = new Rating();
        $ratingModel->add($_POST['movie_id'], $_POST['rating']);
        header('Location: /movie/detail/' . $_POST['imdb_id']);
    }

    public function review($imdbID) {
        $movieModel = new Movie();
        $reviewModel = new Review();

        $movie = $movieModel->getOrCreateByImdb($imdbID);
        $existing = $reviewModel->get($movie['id']);

        if (!$existing) {
            $text = $reviewModel->generate(json_decode($movie['data'], true));
            $reviewModel->save($movie['id'], $text);
            echo $text;
        } else {
            echo $existing;
        }
    }
}
