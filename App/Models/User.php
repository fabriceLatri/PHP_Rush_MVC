<?php

namespace App\Models;

class User
{
  /**
   * @type integer
   */
  private $id;

  /**
   * @type string
   */
  private $username;

  /**
   * @type string
   */
  private $email;

  /**
   * @type string
   */
  private $password;

  /**
   * @type string
   */
  private $passwordVerify;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  public function getUsername(): ?string
  {
    return $this->username;
  }

  public function setUsername(string $username): self
  {
    $this->username = $username;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  public function getPasswordVerify()
  {
    return $this->passwordVerify;
  }

  public function setPasswordVerify(string $passwordVerify)
  {
    $this->passwordVerify = $passwordVerify;

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

    if (isset($this->passwordVerify) && (empty($this->username) || strlen($this->username) < 3 || strlen($this->username > 10))) {
      $err = $err . "Invalid 'username' field. Must have at least 3 and at most 10 characters.<br>";
    }
    if (empty($this->email) || /*preg_match('#^[a-zA-Z0-9]+@[a-zA-Z]{2,}\.[a-z]{2,4}$#', $this->email) != 1 */ !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $err = $err . "Invalid 'email' field. Wrong format.<br>";
    }
    if (empty($this->password)) {
      $err = $err . "Invalid 'password' field. Can't be blank.<br>";
    }
    if (isset($this->passwordVerify) && !empty($this->password) && (strlen($this->password) < 8 || strlen($this->password) > 20)) {
      $err = $err . "Invalid 'password' field. Must have at least 8 and at most 20 characters<br>";
    }
    if (isset($this->passwordVerify) && empty($this->passwordVerify)) {
      $err = $err . "Invalid 'password confirmation' field. Can't be blank.<br>";
    }
    if (isset($this->passwordVerify) && $this->passwordVerify !== $this->password && !empty($this->passwordVerify)) {
      $err = $err . "Invalid 'password confirmation' field. The password confirmation is different from the password.<br>";
    }

    if (!empty($err)) {
      throw new \Exception($err);
    }

    return $err;
  }

  public static function createTableInDBIfNotExists(): string
  {
    return "CREATE TABLE IF NOT EXISTS users (
      id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
      username VARCHAR(100),
      email VARCHAR(255),
      password VARCHAR(255),
      creation_date DATETIME,
      update_date DATETIME
    )";
  }

  public function addUser()
  {
    return "INSERT INTO users (username, email, password, creation_date, update_date) VALUES (:username, :email, :password, NOW(), NOW())";
  }

  public function selectUserEmail()
  {
    return 'SELECT * FROM users WHERE email = :email';
  }

  public function selectAllUser()
  {
    return "SELECT * FROM users";
  }

  public function selectUserId()
  {
    return "SELECT * FROM users WHERE id = :id";
  }

  public function updateInfoUser()
  {
    return "UPDATE users SET username = :username, email = :email, password = :password, update_date = NOW() WHERE id = :id";
  }

  public function deleteUserId()
  {
    return "DELETE FROM users WHERE id = :id";
  }
}
