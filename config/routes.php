<?php

$router->use('GET', '/auth/register', new App\Controllers\AuthController(), 'register_view');
$router->use('POST', '/auth/register', new App\Controllers\AuthController(), 'register');

$router->use('GET', '/error404', new App\Controllers\Error404Controller(), 'error404_view');

$router->use('GET', '/auth/login', new App\Controllers\LoginController(), 'login_view');
$router->use('POST', '/auth/login', new App\Controllers\LoginController(), 'login');

$router->use('GET', '/users/userPanel', new App\Controllers\UserPanelController(), 'user_view');
$router->use('POST', '/users/userPanel', new App\Controllers\UserPanelController(), 'user');