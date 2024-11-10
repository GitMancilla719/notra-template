<?php

namespace App\Core;

use mysqli;
use Exception;

class Database {
    // Static properties to hold the database credentials and connection
    private static $host;
    private static $username;
    private static $password;
    private static $dbname;
    private static $conn;

    // Static method to initialize the connection
    public static function initialize() {
        if (self::$conn === null) {
            self::$host = $_ENV['DB_HOST'] ?? 'localhost';
            self::$username = $_ENV['DB_USER'] ?? 'root';
            self::$password = $_ENV['DB_PASSWORD'] ?? '';
            self::$dbname = $_ENV['DB_NAME'] ?? '';

            // Attempt to connect to the MySQL database
            self::connect();
        }
    }

    // Static method to connect to the database
    private static function connect() {
        // Create connection
        self::$conn = new mysqli(self::$host, self::$username, self::$password, self::$dbname);

        // Check connection
        if (self::$conn->connect_error) {
            // Throw an exception if connection fails
            throw new Exception("Connection failed: " . self::$conn->connect_error);
        }
    }

    // Static function to return the connection object
    public static function getConnection() {
        // Ensure that the connection is initialized
        if (self::$conn === null) {
            self::initialize();
        }

        return self::$conn;
    }

    // Static destructor to close the connection
    public static function close() {
        if (self::$conn) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}
