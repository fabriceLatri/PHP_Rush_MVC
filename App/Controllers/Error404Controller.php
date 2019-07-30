<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

class Error404Controller extends AppController{

    public function error404_view(Request $request)
    {
        return $this->render('errors/error404.html.twig', ['base' => $request->base, 'error' => $this->flashError]);
    }
}