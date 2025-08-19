<?php

$router->addRoute('GET', '/', 'HomeController', 'index');
$router->addRoute('POST', '/contactForm', 'HomeController', 'handleContactForm');

$router->addRoute('GET', '/register', 'AuthController', 'register')->auth('guest');
$router->addRoute('POST', '/register', 'AuthController', 'handleRegister')->auth('guest');

$router->addRoute('GET', '/login', 'AuthController', 'login')->auth('guest');
$router->addRoute('POST', '/login', 'AuthController', 'handleLogin')->auth('guest');

$router->addRoute('GET', '/verify_email', 'AuthController', 'verify')->auth('guest');
$router->addRoute('GET', '/verify', 'AuthController', 'verifyEmail')->auth('guest');
// Add this to your routes configuration
$router->addRoute('POST', '/resendVerificationEmail', 'AuthController', 'resendVerificationEmail')->auth('guest');


$router->addRoute('GET', '/dashboard', 'DashboardController', 'index')->auth('user');
$router->addRoute('GET', '/dashboard/:username?', 'DashboardController', 'index')->auth('user');





// $router->addRoute('GET', '/auth/verify', 'AuthController', 'handleRegister');

// $router->addRoute('GET', '/user/:num', 'UserController', 'show')->auth();
// $router->addRoute('POST', '/user/:any', 'UserController', 'create')->auth();
// $router->addRoute('GET', '/login', 'AuthController', 'login')->auth();
// $router->addRoute('GET', '/admin', 'AdminController', 'index')->auth()->handleRole('admin');