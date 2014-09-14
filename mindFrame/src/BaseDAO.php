<?php

namespace mindFrame;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

abstract class BaseDAO
{

  protected $dataSource;

  /**
   * Constructs data access object with a data source. In case of DB it is \PDO object.
   *
   * @param $dataSource
   */
  function __construct($dataSource)
  {
    $this->dataSource = $dataSource;
  }

}