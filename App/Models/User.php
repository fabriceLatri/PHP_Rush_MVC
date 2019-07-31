<?php

namespace App\Models;

class User
{
  /**
   * @type integer
   */
  public $id;

  /**
   * @type string
   */
  public $username;

  /**
   * @type string
   */
  public $email;

  /**
   * @type string
   */
  public $password;

    /**
   * @type string
   */
  public $passwordVerify;

  public function getId(): ?int
  {
    return $this->id;
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

    if (empty($this->username) || strlen($this->username) < 3 || strlen($this->username > 10)) {
      $err = $err . "Invalid 'username' field. Must have at least 3 and at most 10 characters.<br>";
    }
    if (empty($this->email) || preg_match('#^[a-zA-Z0-9]+@[a-zA-Z]{2,}\.[a-z]{2,4}$#', $this->email) != 1) {
      $err = $err . "Invalid 'email' field. Wrong format.<br>";
    }
    if (empty($this->password)) {
      $err = $err . "Invalid 'password' field. Can't be blank.<br>";
    }
    if (isset($this->passwordVerify) && !empty($this->password) && (strlen($this->password) < 8 || strlen($this->password) > 20)) {
      $err = $err . "Invalid 'password' field. Must have at least 8 and at most 20 characters<br>";
    }
    if (isset($this->passwordVerify) && empty($this->passwordVerify)) {
      $err = $err. "Invalid 'password confirmation' field. Can't be blank.<br>";
    }
    if (isset($this->passwordVerify) && $this->passwordVerify !== $this->password && !empty($this->passwordVerify)) {
      $err = $err. "Invalid 'password confirmation' field. The password confirmation is different from the password.<br>";
    }

    if (!empty($err)) {
      throw new \Exception($err);
    }

    return $err;
  }
}
