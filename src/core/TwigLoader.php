<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigLoader {
    // Make the $twig property static
    private static $twig;

    // Static constructor (since the class is static, we need a static method to initialize)
    public static function initialize() {
        if (self::$twig === null) {
            // Set up the Twig loader and environment
            $loader = new FilesystemLoader('src/views');
            self::$twig = new Environment($loader);
        }
    }

    // Static render method
    public static function render($template, $data = []) {
        // Ensure that the twig instance is initialized
        if (self::$twig === null) {
            self::initialize();
        }

        // Render the template
        echo self::$twig->render($template, $data);
    }
}
