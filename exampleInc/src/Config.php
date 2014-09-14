<?php

namespace exampleInc;

use mindFrame\BaseConfig;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class Config extends BaseConfig
{

  public $dbType = 'mysql';
  public $host = 'localhost';
  public $dbName = '';
  public $dbUser = '';
  public $dbPass = '';

  public $cryptSalt = 'someSALT-CHANGE-IT';

  public $memcacheHost = false;
  public $memcachePort = '11211';

}