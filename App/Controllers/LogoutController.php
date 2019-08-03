<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;
use App\Helpers\Session;


use App\Models\User;




class LogoutController extends AppController
{
    public function logout_view(Request $request)
    {
        if (isset($_SESSION)) {
            return $this->render('auth/logout.html.twig', [
                'base' => $request->base,
                'error' => $this->flashError
            ]);
        } else {
            header('location:/PHP_Rush_MVC/auth/login');
        }
    }

    public function logout(Request $request)
    {
        $user = new User();
        session_destroy();
        echo "You are disconnected !";
        header('refresh:3; /PHP_Rush_MVC/auth/login');

        die();
    }
}
