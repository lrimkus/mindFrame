<?php

namespace exampleInc\apps\frontWeb\domain\forms;

  /**
   * Miserable Mind | http://www.miserablemind.com
   * mindFrame - Micro PHP Framework
   * The MIT License (MIT)
   */

/**
 * Form used for sign up and edit profile pages
 */
class UserProfileForm
{

  private $userName;
  private $email;
  private $password;
  private $firstName;
  private $lastName;

  function __construct($email, $firstName, $lastName, $password, $userName)
  {
    $this->email = $email;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->password = $password;
    $this->userName = $userName;
  }

  /**
   * Goes through the fields, validates them and populates $errorMessages if finds violations
   *
   * @return array
   */
  public function getErrorMessages()
  {
    $errorMessages = array();

    if (!$this->firstName) $errorMessages[] = "First Name Field Empty";
    if (!$this->lastName) $errorMessages[] = "Last Name Field Empty";
    if (!$this->userName) $errorMessages[] = "User Name Field Empty";
    if (!$this->password) $errorMessages[] = "Password Field Empty";
    if (!$this->email) $errorMessages[] = "Email Field Empty";

    if (!empty($errorMessages)) return $errorMessages;

    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $errorMessages[] = "Email Is Not Valid";
    }

    if (strlen($this->password) < 6) {
      $errorMessages[] = "Password must be at least 6 characters long";
    }

    return $errorMessages;

  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getEmail()
  {
    return $this->email;
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

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setUserName($userName)
  {
    $this->userName = $userName;
  }

  public function getUserName()
  {
    return $this->userName;
  }


}