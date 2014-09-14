<?php

namespace exampleInc\model\user;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

class UserManager
{

  private $cryptSalt;

  /**
   * @var UserSQLDAO
   */
  private $userDAO;

  /** @var  \Memcached */
  private $cache;

  function __construct($userDAO, $cache, $cryptSalt)
  {
    $this->cache = $cache;
    $this->userDAO = $userDAO;
    $this->cryptSalt = $cryptSalt;
  }


  public function getUserById($userId)
  {
    return $this->userDAO->getUserById($userId);
  }

  /**
   * Gets User, used  mainly for Log In
   *
   * @param $username
   * @param $password - plain text password
   * @return User
   */
  public function getUserByLogInAndPassword($username, $password)
  {
    $hashedPassword = crypt($password, $this->cryptSalt);
    return $this->userDAO->getUserByLogInAndPassword($username, $hashedPassword);
  }

  /**
   * Gets User by Username. Username is unique.
   *
   * @param $username
   * @return User
   */
  public function getUserByUsername($username)
  {
    return $this->userDAO->getUserByUsername($username);
  }

  /**
   * Gets user by it's e-mail address. E-mail address is unique.
   *
   * @param $email
   * @return User
   */
  public function getUserByEmail($email)
  {
    return $this->userDAO->getUserByEmail($email);
  }

  /**
   * Registers a new user and returns the user if succeeds, otherwise returns false
   *
   * @param $firstName
   * @param $lastName
   * @param $userName
   * @param $email
   * @param $password - plain text password
   * @return User
   */
  public function registerUser($firstName, $lastName, $userName, $email, $password)
  {
    $hashedPassword = crypt($password, $this->cryptSalt);
    return $this->userDAO->insertUser($firstName, $lastName, $userName, $email, $hashedPassword);
  }

  /**
   * Updates user data and returns the updates user if succeeds, otherwise false
   *
   * @param User $user
   * @param string $firstName
   * @param string $lastName
   * @param string $username
   * @param string $email
   * @param string $password - plain text password
   * @return bool|mixed|null
   */
  public function updateUser(User $user, $firstName, $lastName, $username, $email, $password)
  {
    $hashedPassword = crypt($password, $this->cryptSalt);

    $userUpdated = $this->userDAO->updateUser($user->getId(), $firstName, $lastName, $username, $email, $hashedPassword);

    if ($userUpdated) return $this->getUserById($user->getId());
    else return false;

  }


}