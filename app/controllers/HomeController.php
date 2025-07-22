<?php
class HomeController extends Controller {
    public function index() {
        session_start();
        if (isset($_SESSION['user'])) {
            header("Location: /movie/search");
            exit;
        }
        $this->view('home/index');
    }
}
