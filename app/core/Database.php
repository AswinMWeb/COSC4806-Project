<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            $host = "iceg1.h.filess.io";
            $port = 3305; 
            $dbname = "cosc4806_palerawwhy";
            $username = "cosc4806_palerawwhy";
            $password = $_ENV['DB_PASS']; 

            try {
                $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
                self::$pdo = new PDO($dsn, $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
