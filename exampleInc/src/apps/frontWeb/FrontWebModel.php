<?php

namespace exampleInc\apps\frontWeb;

use exampleInc\model\user\User;
use mindFrame\BaseModel;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Model class for the app.
 */
class FrontWebModel extends BaseModel
{

  /** @var  User */
  private $activeUser;

  /** @var  FrontWebProperties */
  private $appProperties;

  private $errorMessages = array();

  public function getActiveUser()
  {
    return $this->activeUser;
  }

  /**
   * @param User $activeUser
   */
  public function setActiveUser($activeUser)
  {
    $this->activeUser = $activeUser;
  }

  public $data = array();

  /**
   * @return array
   */
  public function getErrorMessages()
  {
    return $this->errorMessages;
  }

  public function addErrorMessage($errorMessage)
  {
    $this->errorMessages[] = $errorMessage;
  }

  public function addErrorMessages(array $errorMessages)
  {
    $this->errorMessages = array_merge($this->errorMessages, $errorMessages);
  }

  public function setAppProperties($appProperties)
  {
    $this->appProperties = $appProperties;
  }

  public function getAppProperties()
  {
    return $this->appProperties;
  }


}