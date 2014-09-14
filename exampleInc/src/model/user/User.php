<?php

namespace exampleInc\model\user;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

class User
{
  private $id;
  private $userName;
  private $firstName;
  private $lastName;
  private $hashedPassword;
  private $email;

  function __construct($id, $firstName, $lastName, $userName, $hashedPassword, $email)
  {
    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->userName = $userName;
    $this->hashedPassword = $hashedPassword;
    $this->email = $email;
  }


  public function setFirstName($firstName)
  {
    $this->firstName = $firstName;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }

  public function setLastName($lastName)
  {
    $this->lastName = $lastName;
  }

  public function getLastName()
  {
    return $this->lastName;
  }

  public function setUserName($userName)
  {
    $this->userName = $userName;
  }

  public function getUserName()
  {
    return $this->userName;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setHashedPassword($hashedPassword)
  {
    $this->hashedPassword = $hashedPassword;
  }

  public function getHashedPassword()
  {
    return $this->hashedPassword;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getEmail()
  {
    return $this->email;
  }

}