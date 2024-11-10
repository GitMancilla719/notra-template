<?php

namespace App\Controller\Auth;

use App\Core\Auth;
use App\Core\TwigLoader;
use Exception;

class AuthController {
    public static function login() {
        try {
            $auth = new Auth();
            $username = 'newuser';
            $password = 'password123';

            if ($auth->login($username, $password)) {
                echo "Login successful!";
            }

            echo 'test: ' . $_SESSION['username'];
            // TwigLoader::render('home/Home.twig');
        } catch (Exception $e) {
            // Handle the exception and display an error message
            echo "Error: " . $e->getMessage();
        }
    }
    public static function register() {
        try {
            $auth = new Auth();
            $username = 'newuseradmin1';
            $password = 'password123';

            if ($auth->register($username, $password)) {
                echo "User registered successfully!";
                // header('admin/login');
            }
            // TwigLoader::render('home/Home.twig');
        } catch (Exception $e) {
            // Handle the exception and display an error message
            echo "Error: " . $e->getMessage();
        }
    }

    public static function logout() {
        try {
            $auth = new Auth();
            $auth->logout();

            echo "Logged out successfully!";
            // TwigLoader::render('home/Home.twig');
        } catch (Exception $e) {
            // Handle the exception and display an error message
            echo "Error: " . $e->getMessage();
        }
    }
}
