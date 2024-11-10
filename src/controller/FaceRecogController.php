<?php

namespace App\Controller;

use App\Core\TwigLoader;
use Exception;

class FaceRecogController {
    public static function index() {
        try {
            echo 'halo';
            // TwigLoader::render('pages/Home/Home.twig');
        } catch (Exception $e) {
            // Handle the exception and display an error message
            echo "Error: " . $e->getMessage();
        }
    }
}
