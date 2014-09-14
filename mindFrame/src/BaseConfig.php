<?php

namespace mindFrame;

  /**
   * Miserable Mind | http://www.miserablemind.com
   * mindFrame - Micro PHP Framework
   * The MIT License (MIT)
   */

/**
 * Basic system config file. It needs to be overridden by config file in implementation.
 * The variables declared here need to be overridden with appropriate values
 */
abstract class BaseConfig
{

  /*  DB config */
  public $dbType;
  public $host;
  public $dbName;
  public $dbUser;
  public $dbPass;

  /* Crypt Password Salt */
  public $cryptSalt;

  /**
   * Memcache Config
   */
  public $memcacheHost;
  public $memcachePort;

}