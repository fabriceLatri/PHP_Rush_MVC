<?php

$router->use('GET', '/auth/register', new App\Controllers\AuthController(), 'register_view');
$router->use('POST', '/auth/register', new App\Controllers\AuthController(), 'register');
$router->use('GET', '/error404', new App\Controllers\Error404Controller(), 'error404_view');
