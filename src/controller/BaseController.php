<?php

namespace App\Controller;

use App\Core\TwigLoader;
use Exception;

class BaseController {
    public static function index() {
        try {
            TwigLoader::render('pages/Home/Home.twig');
        } catch (Exception $e) {
            // Handle the exception and display an error message
            echo "Error: " . $e->getMessage();
        }
    }
}
