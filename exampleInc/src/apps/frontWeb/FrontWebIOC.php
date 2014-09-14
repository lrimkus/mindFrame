<?php

namespace exampleInc\apps\frontWeb;

use exampleInc\model\user\UserManager;
use exampleInc\model\user\UserSQLDAO;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Inversion of Control Container that is responsible for instantiating and supplying dependencies.
 */
class FrontWebIOC extends \mindFrame\BaseIOC
{
  const USER_MANAGER = 'user_manager';
  const APP_PROPERTIES = 'app_properties';

  /**
   * @return UserManager
   */
  public function getUserManager()
  {
    if (!isset($this->entries[self::USER_MANAGER])) {
      $this->entries[self::USER_MANAGER] = new UserManager(new UserSQLDAO($this->getDBConnection()), $this->getCache(), $this->getConfig()->cryptSalt);
    }
    return $this->entries[self::USER_MANAGER];
  }

  /**
   * @return FrontWebProperties
   */
  public function getAppProperties()
  {
    if (!isset($this->entries[self::APP_PROPERTIES])) {
      $this->entries[self::APP_PROPERTIES] = new FrontWebProperties();
    }
    return $this->entries[self::APP_PROPERTIES];
  }
}