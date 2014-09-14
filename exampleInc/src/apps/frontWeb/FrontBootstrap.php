<?php

namespace exampleInc\apps\frontWeb;

use exampleInc\Config;
use mindFrame\BaseBootStrap;
use mindFrame\BaseUrlMapper;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Main Bootstrap file for this app. It implements and overrides the methods from BaseBootStrap, the framework abstract bootstrap
 */
class FrontBootstrap extends BaseBootStrap
{

  protected $model;
  protected $ioc;
  protected $config;
  protected $urlMapper;

  /**
   * Register relevant namespaces for framework. Uses parent's PSR4 auto-loader
   */
  protected function registerNameSpaces()
  {
    parent::registerNameSpaces();
    $this->autoLoader->addNamespace('exampleInc', dirname(__FILE__) . '/../../../../exampleInc/src');
  }


  /**
   * Initiates and supplies the Model for the app
   *
   * @return FrontWebModel
   */
  protected function getModel()
  {
    if (!$this->model) $this->model = new FrontWebModel();
    return $this->model;
  }

  /**
   * Initiates and supplies the Config for the app
   *
   * @return Config
   */
  protected function getConfig()
  {
    if (!$this->config) $this->config = new Config();
    return $this->config;
  }

  /**
   * Initiates and supplies the IOC container for the app
   *
   * @param $config
   * @return FrontWebIOC
   */
  protected function getIOC($config)
  {
    if (!$this->ioc) $this->ioc = new FrontWebIOC($config);
    return $this->ioc;
  }

  /**
   * Loads the router from the routes file
   *
   * @param \mindFrame\BaseUrlMapper $urlMapper
   */
  protected function registerRoutes(BaseUrlMapper $urlMapper)
  {
    require 'routes.php';
  }
}