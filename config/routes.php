<?php

$router->use('GET', '/auth/register', new App\Controllers\AuthController(), 'register_view');
$router->use('POST', '/auth/register', new App\Controllers\AuthController(), 'register');

$router->use('GET', '/error404', new App\Controllers\Error404Controller(), 'error404_view');

$router->use('GET', '/auth/login', new App\Controllers\LoginController(), 'login_view');
$router->use('POST', '/auth/login', new App\Controllers\LoginController(), 'login');

$router->use('GET', '/articles/addArticle', new App\Controllers\ArticleController(), 'addArticle_view');
$router->use('POST', '/articles/addArticle', new App\Controllers\ArticleController(), 'addArticle');

$router->use('GET', '/articles/listArticle', new App\Controllers\ListarticleController(), 'listArticle_view');
