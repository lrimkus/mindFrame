<?php

namespace exampleInc\model\user;

use mindFrame\BaseDAO;
use PDO;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class UserSQLDAO extends BaseDAO
{
  /** @var \PDO */
  protected $dataSource;

  const SELECT_USER = 'SELECT  user_id as id
                             , first_name as firstName
                             , last_name as lastName
                             , username as userName
                             , email
                             , password
                         FROM user ';


  /**
   * Maps SQL result to User Objects
   *
   * @param array $result
   * @return User[]
   */
  protected function mapUsers(Array $result)
  {
    $users = array();

    if (empty($result)) return $users;

    foreach ($result as $user) {
      $users[] = new User($user['id'], $user['firstName'], $user['lastName'], $user['userName'], $user['password'], $user['email']);
    }

    return $users;
  }

  public function getUserById($id)
  {
    $queryString = self::SELECT_USER . ' WHERE user_id = :id';

    $query = $this->dataSource->prepare($queryString);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll();

    $usersFound = $this->mapUsers($result);

    if (!empty($usersFound)) return array_pop($usersFound);

    return null;

  }

  /**
   * @param $userName
   * @param $hashedPassword
   * @return User
   */
  public function getUserByLogInAndPassword($userName, $hashedPassword)
  {
    $queryString = self::SELECT_USER . ' WHERE username = :username AND password = :password';
    $query = $this->dataSource->prepare($queryString);

    $query->bindParam(':username', $userName, PDO::PARAM_STR);
    $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    $usersFound = $this->mapUsers($result);
    if (!empty($usersFound)) return array_pop($usersFound);

    return null;

  }

  /**
   * @param $userName
   * @return User
   */
  public function getUserByUsername($userName)
  {
    $queryString = self::SELECT_USER . ' WHERE username = :username';
    $query = $this->dataSource->prepare($queryString);

    $query->bindParam(':username', $userName, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    $usersFound = $this->mapUsers($result);
    if (!empty($usersFound)) return array_pop($usersFound);

    return null;
  }

  /**
   * @param $email
   * @return User
   */
  public function getUserByEmail($email)
  {
    $queryString = self::SELECT_USER . ' WHERE email = :email';
    $query = $this->dataSource->prepare($queryString);

    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    $usersFound = $this->mapUsers($result);
    if (!empty($usersFound)) return array_pop($usersFound);

    return null;
  }

  /**
   * @param $firstName
   * @param $lastName
   * @param $userName
   * @param $email
   * @param $hashedPassword
   * @return User
   */
  public function insertUser($firstName, $lastName, $userName, $email, $hashedPassword)
  {

    $queryString = 'INSERT INTO user (first_name, last_name, email, username, password)
    VALUES (:first_name, :last_name, :email, :username, :password)';

    $sql = $this->dataSource->prepare($queryString);
    $sql->bindValue(':first_name', $firstName);
    $sql->bindValue(':last_name', $lastName);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':username', $userName);
    $sql->bindValue(':password', $hashedPassword);

    if ($sql->execute()) {
      $id = $this->dataSource->lastInsertId();
      return new User($id, $firstName, $lastName, $userName, $hashedPassword, $email);
    }

    return null;

  }

  public function updateUser($id, $firstName, $lastName, $username, $email, $hashedPassword)
  {
    $queryString = 'UPDATE user SET first_name= :first_name
                                   , last_name=:last_name
                                   , email=:email
                                   , password=:password
                                   , username=:username
                               WHERE user_id=:id';
    $sql = $this->dataSource->prepare($queryString);
    $sql->bindValue(':first_name', $firstName);
    $sql->bindValue(':last_name', $lastName);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':username', $username);
    $sql->bindValue(':password', $hashedPassword);
    $sql->bindValue(':id', $id);

    if ($sql->execute()) {
      return true;
    }

    return false;
  }


}