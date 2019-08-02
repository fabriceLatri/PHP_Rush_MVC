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
      // $user->validate();
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'auth/login', '302');
      return;
    }

    // $query = $this->orm->getDb()->prepare($user->selectUserEmail());
    // $array = [
    //   'email' =>$request->params['email']
    // ];

    $userInfo = $this->orm->prepareRequest($user,"selectUserEmail",['email']);
      var_dump($userInfo);
    // $query->execute(['email']);
    ;
    if (!empty($userInfo) && password_verify($request->params['password'], $userInfo[0]['password'])){
      $this->session->set('id' , $userInfo[0]['id']);

    }
    else {
      echo 'Incorrect Email or Password';
      header('refresh:1; /PHP_Rush_MVC/auth/login');
    }
    die();
  }
}
