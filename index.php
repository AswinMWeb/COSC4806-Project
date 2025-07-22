<?php
session_start();

require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/app/models/Movie.php';
require_once __DIR__ . '/app/models/Rating.php';
require_once __DIR__ . '/app/models/User.php'; 
require_once __DIR__ . '/app/controllers/MovieController.php';
require_once __DIR__ . '/app/controllers/AuthController.php'; 

use App\Controllers\MovieController;
use App\Controllers\AuthController;

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'search':
        (new MovieController())->search();
        break;
    case 'rate':
        (new MovieController())->rate();
        break;
    case 'review':
        (new MovieController())->review();
        break;
    case 'login':
        (new AuthController())->login();
        break;
    case 'register':
        (new AuthController())->register();
        break;
    case 'guest':
        (new AuthController())->guest();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    default:
        (new MovieController())->index();
        break;
}
