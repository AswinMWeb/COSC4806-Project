<?php

namespace App\Models;


class Movie {
    public static function fetchByTitle($title) {
        $apiKey = $_ENV['OMDB_API_KEY'];
        $url = "https://www.omdbapi.com/?apikey=28f55fa4&t=" . urlencode($title);


        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data && $data['Response'] === "True") {
            return $data;
        } else {
            return null;
        }
    }
}
