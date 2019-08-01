<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;
use App\Helpers\Session;

use App\Models\User;

class LoginController extends AppController
{
  public function login_view(Request $request)
  {
    return $this->render('auth/login.html.twig', ['base' => $request->base,
      'error' => $this->flashError]);
  }

  public function login(Request $request) { 
    $user = new User();
    $user->setEmail($request->params['email']);
    $user->setPassword($request->params['password']);

    try {
      $user->validate();
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'auth/login', '302');
      return;
    }
    $query = $this->orm->getDb()->prepare($user->addUser());
    $array = [
      'username' => $request->params['username'],
      'email' => $request->params['email'],
      'password' => password_hash($request->params['password'], PASSWORD_DEFAULT),
    ];

    $query->execute($array);

    header ('location:/PHP_Rush_MVC/auth/register');

    die();
  }
}
