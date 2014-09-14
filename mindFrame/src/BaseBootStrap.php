<?php

namespace mindFrame;

require 'Psr4AutoloaderClass.php';

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Framework Bootstrap Abstract class. It should be extended by an app bootstrap and all the necessary methods implemented.
 * The entry point is main()
 */
abstract class BaseBootStrap
{
  /** @var  BaseUrlMapper */
  protected $urlMapper;

  /** @var  Psr4AutoloaderClass */
  protected $autoLoader;

  /** @var  BaseController */
  protected $controller;


  /**
   * Main entrance to the program. In web case, it gets called from index.php
   */
  public function main()
  {
    $this->autoLoader = new Psr4AutoloaderClass();
    $this->registerNameSpaces();

    $config = $this->getConfig();
    $ioc = $this->getIOC($config);
    $controller = $this->instantiateController($ioc);
    $model = $this->getModel();

    $this->dispatchRequest($controller, $model);
  }

  /**
   * Registers Name Spaces. Here it does only for the framework, app implementation should override the method and add its own namespaces.
   */
  protected function registerNameSpaces()
  {
    $this->autoLoader->register();
    $this->autoLoader->addNamespace('mindFrame', dirname(__FILE__));
  }


  /**
   * Calls all the handles of controller to complete the request.
   * Note: PostHandle is not called if preHandle fails.
   *
   * @param $controller BaseController
   * @param $model BaseModel
   * @return bool
   */
  protected function dispatchRequest($controller, $model)
  {
    if ($controller->prehandle($model)) {
      $controller->handleRequest($model);
      $controller->postHandle($model);
      return true;
    }

    return false;
  }

  /**
   * Instantiates URLMapper. Should be overridden in case needed customization.
   *
   * @param $namespacePrefix
   * @return BaseUrlMapper
   */
  protected function getURLMapper($namespacePrefix)
  {
    if (!$this->urlMapper) {
      $this->urlMapper = new BaseUrlMapper($namespacePrefix);
      $this->registerRoutes($this->urlMapper);
    }
    return $this->urlMapper;
  }

  /**
   * Returns a new Instance of controller that handles the request
   *
   * @param $ioc BaseIOC
   * @return BaseController
   */
  protected function instantiateController($ioc)
  {

    if ($this->controller) return $this->controller;

    $appProperties = $ioc->getAppProperties();
    $namespacePrefix = $appProperties->getControllerNamespacePrefix();
    $mapper = $this->getURLMapper($namespacePrefix);
    $page = (!empty($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/') ? substr($_SERVER['PATH_INFO'], 1) : '';

    if (!$controllerName = $mapper->getPageController($page)) {
      header("404 Not Found", null, 404);
      exit;
    }

    $this->controller = new $controllerName($ioc, $mapper->getUrlVariables());
    return $this->controller;
  }

  /**
   * Registers Routes using BaseUrlMapper
   *
   * @param $urlMapper BaseUrlMapper
   * @return void
   */
  abstract protected function registerRoutes(BaseUrlMapper $urlMapper);

  /**
   * Return Model that gets injected to controller.
   *
   * @return BaseModel
   */
  abstract protected function getModel();

  /**
   * Returns the config for the module being bootstrapped
   *
   * @return BaseConfig
   */
  abstract protected function getConfig();

  /**
   * Returns new instance of the IOC container for the app
   *
   * @param BaseConfig $config
   * @return BaseIOC
   */
  abstract protected function getIOC($config);

}