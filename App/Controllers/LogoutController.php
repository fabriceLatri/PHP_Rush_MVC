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
        if (!empty($_SESSION)) {
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
        $this->session->getValues();
        $this->session->remove("id");
        $this->session->destroy();

        header('location: /PHP_Rush_MVC/auth/login');

        die();
    }
}
