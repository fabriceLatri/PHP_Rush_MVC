<?php

namespace App\Models;

class Article
{
  /**
   * @type integer
   */
  private $id;

  /**
   * @type string
   */
  private $title;

  /**
   * @type string
   */
  private $content;

  /**
   * @type string
   */
  private $author;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function setId($id): self
  {
    $this->id = $id;
    return $this;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function setTitle(string $title): self
  {
    $this->title = $title;

    return $this;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }

  public function setContent(string $content): self
  {
    $this->content = $content;

    return $this;
  }

  public function getAuthor(): ?string
  {
    return $this->author;
  }

  public function setAuthor(string $author): self
  {
    $this->author = $author;

    return $this;
  }

  /**
   * Validate the User model data.
   *
   * @return string - Error message if the model data is invalid, else empty string.
   */
  public function validate(): string
  {
    $err = '';

    if (empty($this->title)) {
      $err = $err . "Invalid 'title' field.Can't be blank<br>";
    }
    if (empty($this->content)) {
      $err = $err . "Invalid 'content' field. Can't be blank.<br>";
    }
    if (empty($this->author)) {
      $err = $err . "Invalid 'author' field. Can't be blank.<br>";
    }

    if (!empty($err)) {
      throw new \Exception($err);
    }

    return $err;
  }

  public function addArticle(){
    return "INSERT INTO articles (title, content, author, creation_date, update_date) VALUES (:title, :content, :author, NOW(), NOW())";
  }

  public function selectArticleTitle(){
    return 'SELECT * FROM articles WHERE title = :title';
  }

  public function selectAllArticle(){
    return "SELECT * FROM articles ORDER BY update_date DESC";
  }

  public function selectArticleId(){
    return 'SELECT * FROM articles WHERE id = :id';
  }

  public function updateInfoArticle(){
    return "UPDATE articles SET title = :title, content = :content, author = :author, update_date = NOW() WHERE id = :id";
  }

  public function deleteUserId(){
    return "DELETE FROM articles WHERE id = :id";
  }
}