<?php

use App\Core\Router;
use App\Core\TwigLoader;

// ROUTES
Router::init();

// Public Routes
Router::addRoute($_ENV['APP_NAME'], [App\Controller\HomeController::class, 'index']);
Router::addRoute('test', [App\Controller\HomeController::class, 'index']);

Router::addRoute('admin/login', [\App\Controller\Auth\AuthController::class, 'login']);
Router::addRoute('admin/hidden/register', [\App\Controller\Auth\AuthController::class, 'register']);

// Protected Routes (add true as third parameter)
Router::addRoute('admin/logout', [\App\Controller\Auth\AuthController::class, 'logout'], true);
Router::addRoute('admin', [App\Controller\HomeController::class, 'index'], true);

// Direct Render Routes
Router::addRoute('404', function () {
  TwigLoader::render('404/404.twig');
});


// test facerecog
Router::addRoute('recog', [App\Controller\FaceRecogController::class, 'index']);

Router::resolve();
// ROUTES
