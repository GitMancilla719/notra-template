<?php
// GLOBAL CONFIGURATIONS
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables
if (file_exists(__DIR__ . '/../.env')) {
  $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
  $dotenv->load();
} else {
  throw new Exception('.env file not found.');
}
