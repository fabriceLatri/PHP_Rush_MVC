<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Request;

use App\Models\User;

class AuthController extends AppController
{
  public function register_view(Request $request)
  {
    return $this->render('auth/register.html.twig', [
      'base' => $request->base,
      'error' => $this->flashError
    ]);
  }

  public function register(Request $request)
  {
    $user = new User();
    $user->setUsername($request->params['username']);
    $user->setEmail($request->params['email']);
    $user->setPassword($request->params['password']);
    $user->setPasswordVerify($request->params['passwordVerify']);

    // $this->orm->persist($user);

    try {
      $user->validate();
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'auth/register', '302');
      return;
    }

    $query = $this->orm->getDb()->prepare($user->addUser());
    $array = [
      'username' => htmlentities($request->params['username']),
      'email' => htmlentities($request->params['email']),
      'password' => password_hash(htmlentities($request->params['password']), PASSWORD_DEFAULT),
    ];

    try {
      $query->execute($array);

      header('location:/PHP_Rush_MVC/auth/login');
    } catch (\Exception $e) {
      if ($e->getMessage() === "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'mvc.users' doesn't exist") {
        $query = $this->orm->getDb()->prepare(User::createTableInDBIfNotExists());

        $query->execute();

        $this->register($request);
      } else {
        $this->flashError->set($e->getMessage());
        $this->redirect('/' . $request->base . 'auth/register', '302');
      }
    }


    die();
  }
}
