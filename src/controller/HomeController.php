<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\TwigLoader;
use Exception;

class HomeController {
    public static function index() {
        try {

            // echo $_SESSION['username'];
            // echo $_SERVER['REQUEST_METHOD'];

            $conn = Database::getConnection();
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            Database::close();

            $users = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                    // echo $row['id'];
                    // echo $row['name'];
                    // echo $row['email'];
                }
            }

            // Prepare data to pass to the view
            $data = [
                'title' => 'Test Page',
                'message' => 'Test is working',
                // 'users' => $users
            ];

            TwigLoader::render('pages/Home/Home.twig', $data);
        } catch (Exception $e) {
            // Handle the exception and display an error message
            echo "Error: " . $e->getMessage();
        }
    }
}
