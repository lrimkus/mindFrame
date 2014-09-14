<?php

namespace exampleInc\apps\frontWeb;

use mindFrame\BaseProperties;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Property class for the app. Holds app-specific configuration.
 */
class FrontWebProperties extends BaseProperties
{

  private $appName = "Example Front";
  private $serviceEmail = "service@example.com";
  private $controllerNamespacePrefix = 'exampleInc\apps\frontWeb\controllers\\';

  public function getAppName()
  {
    return $this->appName;
  }

  public function getServiceEmail()
  {
    return $this->serviceEmail;
  }

  public function getControllerNamespacePrefix()
  {
    return $this->controllerNamespacePrefix;
  }

}