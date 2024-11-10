<?php

namespace App\Core;

use App\Core\Database;
use Exception;

class Auth {
  private $conn;

  public function __construct() {
    // Get the database connection
    $this->conn = Database::getConnection();
  }

  // Register a new user
  public function register(string $username, string $password): bool {
    // Check if the user already exists
    if ($this->userExists($username)) {
      throw new Exception("Username already exists");
    }

    // Hash the password and insert the user into the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    return $stmt->execute();
  }

  // Check if a user exists
  private function userExists(string $username): bool {
    $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
  }

  // Login user
  public function login(string $username, string $password): bool {
    $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
      throw new Exception("Invalid username or password");
    }

    $stmt->bind_result($id, $storedPassword);
    $stmt->fetch();

    // Verify the password
    if (!password_verify($password, $storedPassword)) {
      throw new Exception("Invalid username or password");
    }

    // Set session data on successful login
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;

    return true;
  }

  // Check if the user is logged in
  public function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
  }

  // Logout user
  public function logout(): void {
    session_unset();
    session_destroy();
  }
}
