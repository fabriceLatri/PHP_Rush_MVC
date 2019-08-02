<?php

namespace App\Controllers;

use WebFramework\AppController;
use WebFramework\Router;
use WebFramework\Request;

use App\Models\Article;

class ListarticleController extends AppController
{
  public function listArticle_view(Request $request)
  { 
    $article = new Article();
    $listInfo = $this->orm->prepareRequest($article,"selectAllArticle",['author']);
    $this->render('articles/listArticle.html.twig', ['base' => $request->base,
    'error' => $this->flashError,
    'listInfo' => $listInfo,
    ]);

        // $i = 0;   
        // $this->render('articles/listArticle.html.twig', ['base' => $request->base,
        // 'error' => $this->flashError,
        // 'i' => $i + 1,
        // 'id' => $listInfo[$i]['id'],
        // 'title' => $listInfo[$i]['title'],
        // 'content' => $listInfo[$i]['content'],
        // 'author' => $listInfo[$i]['author'],
        // ]);

    // for ($i = 0; $i < count($listInfo); $i++){
    //     $this->render('articles/tableArticle.html.twig', ['base' => $request->base,  
    //   'error' => $this->flashError,
    //     'i' => $i + 1,
    //     'id' => $listInfo[$i]['id'],
    //     'title' => $listInfo[$i]['title'],
    //     'content' => $listInfo[$i]['content'],
    //     'author' => $listInfo[$i]['author'],]);
    // }

    // $this->render('articles/endTable.html.twig', ['base' => $request->base,
    //   'error' => $this->flashError,
    // ]);

  }

  public function addArticle(Request $request) { 
    $article = new Article();
    $article->setTitle($request->params['title']);
    $article->setContent($request->params['content']);
    $article->setAuthor($request->params['author']);

    try {
      $article->validate();
    } catch (\Exception $e) {
      $this->flashError->set($e->getMessage());
      $this->redirect('/' . $request->base . 'articles/addArticle', '302');
      return;
    }

    $query = $this->orm->getDb()->prepare($article->addArticle());
    $array = [
      'title' => $request->params['title'],
      'content' => $request->params['content'],
      'author' => $request->params['author']
    ];

    $query->execute($array);


    // header ('location:/PHP_Rush_MVC/auth/login');

    die();
  }
}