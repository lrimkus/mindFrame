<?php

namespace mindFrame;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

abstract class BaseProperties
{

  /**
   * App Name. Needed all over the place, this is why it is required.
   *
   * @return string
   */
  public abstract function getAppName();

  /**
   * Returns prefix to a controller folder for the app.
   *
   * @return string
   */
  public abstract function getControllerNamespacePrefix();

} 