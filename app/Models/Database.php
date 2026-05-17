<?php
namespace App\Models;

class Database {
    private static ?\mysqli $connection = null;

    public static function connect(): \mysqli {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $host = getenv('DB_HOST') ?: 'localhost';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        $name = getenv('DB_NAME') ?: 'residentia';

        self::$connection = new \mysqli($host, $user, $pass, $name);

        if (self::$connection->connect_errno) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'DB: ' . self::$connection->connect_error]);
            exit();
        }

        self::$connection->set_charset('utf8mb4');
        return self::$connection;
    }
}
