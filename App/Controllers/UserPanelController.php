<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;
use App\Helpers\Session;

use App\Models\User;

class UserPanelController extends AppController
{
  public function user_view(Request $request)
  {
      if (!empty($_SESSION['id'])) {
      $user = new user();
      $user->setId($_SESSION['id']);
      $userInfo = $this->orm->prepareRequest($user, "selectUserId", ['id']);
      return $this->render('users/userPanel.html.twig', ['base' => $request->base,
        'error' => $this->flashError,
        'userInfo' => $userInfo]);
      } else {
        header('location:/PHP_Rush_MVC/auth/login');
      }
    }
  
    public function user(Request $request) { 
      $user = new User();
      $user->setUsername($request->params['username']);
      $user->setEmail($request->params['email']);
  
      try {
        $user->validate();
      } catch (\Exception $e) {
        $this->flashError->set($e->getMessage());
        $this->redirect('/' . $request->base . 'users/userPanel', '302');
        return;
      }
  
      $query = $this->orm->getDb()->prepare($user->addUser());
      $array = [
        'username' => $request->params['username'],
        'email' => $request->params['email'],
        'user_group' => $request->params['user_group'],
      ];
  
      $query->execute($array);
  
      header('location:/PHP_Rush_MVC/users/userPanel');
  
      // return $this->render('users/userPanel.html.twig', ['base' => $request->base,
      // 'error' => $this->flashError,
      // 'data' => $array]);
  
      die();
    }
}