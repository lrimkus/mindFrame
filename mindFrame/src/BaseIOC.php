<?php

namespace mindFrame;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

abstract class BaseIOC
{

  const DB_CONNECTION = 'db_connection';
  const CACHE = 'cache';

  protected $entries = array();

  /** @var  \mindFrame\BaseConfig */
  private $config;

  function __construct($config)
  {
    $this->config = $config;
  }

  /**
   * Instantiates or returns an existing PDO connection. Returns an error and dies in case it fails.
   *
   * @return \PDO
   */
  public function getDBConnection()
  {
    if (isset($this->entries[self::DB_CONNECTION])) {
      return $this->entries[self::DB_CONNECTION];
    }
    $config = $this->config;
    try {
      return $this->entries[self::DB_CONNECTION] = new \PDO($config->dbType . ':host=' . $config->host . ';dbname=' . $config->dbName, $config->dbUser, $config->dbPass);
    } catch (\PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  /**
   * Instantiates or returns an existing cache.
   *
   * @return \Memcached
   */
  public function getCache()
  {
    if (!$this->config->memcacheHost) {
      return null;
    }

    if (isset($this->entries[self::CACHE])) {
      return $this->entries[self::CACHE];
    }
    $memcache = new \Memcached();
    $memcache->addServer($this->config->memcacheHost, $this->config->memcachePort);
    return $this->entries[self::CACHE] = $memcache;
  }

  /**
   * System Config
   *
   * @return BaseConfig
   */
  public function getConfig()
  {
    return $this->config;
  }


  /**
   * App Properties Object. Needs to be implemented by extending app IOC.
   *
   * @return \mindFrame\BaseProperties
   */
  abstract function getAppProperties();

}