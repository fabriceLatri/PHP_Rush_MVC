<?php

$router->use('GET', '/auth/register', new App\Controllers\AuthController(), 'register_view');
$router->use('POST', '/auth/register', new App\Controllers\AuthController(), 'register');

$router->use('GET', '/error404', new App\Controllers\Error404Controller(), 'error404_view');

$router->use('GET', '/auth/login', new App\Controllers\LoginController(), 'login_view');
$router->use('POST', '/auth/login', new App\Controllers\LoginController(), 'login');

$router->use('GET', '/auth/logout', new App\Controllers\LogoutController(), 'logout_view');
$router->use('POST', '/auth/logout', new App\Controllers\LogoutController(), 'logout');

$router->use('GET', '/users/userPanel', new App\Controllers\UserPanelController(), 'user_view');
$router->use('POST', '/users/userPanel', new App\Controllers\UserPanelController(), 'user');
$router->use('GET', '/users/editUsers', new App\Controllers\UserPanelController(), 'editUser_view');
$router->use('POST', '/users/editUsers', new App\Controllers\UserPanelController(), 'editUser');
$router->use('GET', '/users/deleteUsers', new App\Controllers\UserPanelController(), 'deleteUser_view');
$router->use('POST', '/users/deleteUsers', new App\Controllers\UserPanelController(), 'deleteUser');



$router->use('GET', '/articles/addArticle', new App\Controllers\ArticleController(), 'addArticle_view');
$router->use('POST', '/articles/addArticle', new App\Controllers\ArticleController(), 'addArticle');
$router->use('GET', '/articles/listArticle', new App\Controllers\ListarticleController(), 'listArticle_view');
$router->use('GET', '/articles/editArticle', new App\Controllers\ListarticleController(), 'editArticle_view');
$router->use('POST', '/articles/editArticle', new App\Controllers\ListarticleController(), 'editArticle');
$router->use('GET', '/articles/deleteArticle', new App\Controllers\ListarticleController(), 'deleteArticle_view');
$router->use('POST', '/articles/deleteArticle', new App\Controllers\ListarticleController(), 'deleteArticle');