<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;
use App\Helpers\Session;

use App\Models\User;

class RegisterController extends AppController
{
  public function true_register_view(Request $request)
  {
    return $this->render('register/true_register.html.twig', ['base' => $request->base,
      'error' => $this->flashError]);
  }

  public function true_register(Request $request) {
    $user = new User();
    $user->setUsername($request->params['username']);
    $user->setEmail($request->params['email']);
    $user->setPassword($request->params['password']);
    $user->setPasswordVerify($request->params['passwordVerify']);

    try {
      $user->validate();
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'register/true_register', '302');
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
