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
    if (!empty($_SESSION['id'])) {
      $article = new Article();
      $listInfo = $this->orm->prepareRequest($article, "selectAllArticle", ['author']);
      return $this->render('articles/listArticle.html.twig', [
        'base' => $request->base,
        'error' => $this->flashError,
        'listInfo' => $listInfo,
        'user_group' => $_SESSION['user_group']
      ]);
    } else {
      header('location:/PHP_Rush_MVC/auth/login');
    }
  }

  public function addArticle(Request $request)
  {
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


    header('location:/PHP_Rush_MVC/articles/listArticle');

    die();
  }

  public function editArticle_view(Request $request)
  {
    $article = new Article();
    $listInfo = $this->orm->prepareRequest($article, "selectAllArticle", ['author']);
    $this->render('articles/editArticle.html.twig', [
      'base' => $request->base,
      'error' => $this->flashError,
      'listInfo' => $listInfo,
      'user_group' => $_SESSION['user_group']
    ]);
  }

  public function editArticle(Request $request){
    $article = new Article();
    $article->setId($request->params['id']);
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
    $listInfo = $this->orm->getDb()->prepare($article->updateInfoArticle());
    $update = [
      'id' => $request->params['id'],
      'title' => $request->params['title'],
      'content' => $request->params['content'],
      'author' => $request->params['author']
    ];

    $listInfo->execute($update);

    header('location:/PHP_Rush_MVC/articles/listArticle');

    die();
  }

  public function deleteArticle_view(Request $request)
  {
    $article = new Article();
    $listInfo = $this->orm->prepareRequest($article, "selectAllArticle", ['author']);
    $this->render('articles/deleteArticle.html.twig', [
      'base' => $request->base,
      'error' => $this->flashError,
      'listInfo' => $listInfo,
      'user_group' => $_SESSION['user_group']
    ]);
  }

  public function deleteArticle(Request $request){
    $article = new Article();
    $article->setId($request->params['id']);
    var_dump($_POST['id']);
    $deleteInfo = $this->orm->getDb()->prepare($article->deleteUserId());
    $data = ["id" =>$request->params['id']];
    $deleteInfo->execute($data);

    header('location:/PHP_Rush_MVC/articles/listArticle');
  }
}
