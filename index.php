<?php

require_once "vendor/autoload.php";

use App\Controller\AuthController;
use App\Controller\IndexController;
use App\Router;

Router::route('/', [IndexController::class, 'index']);
Router::route('/login', [AuthController::class, 'loginForm']);
Router::route('/do-login', [AuthController::class, 'login']);
Router::route('/register', [AuthController::class, 'registerForm']);
Router::route('/do-register', [AuthController::class, 'register']);

Router::execute();