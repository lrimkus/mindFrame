<?php

namespace mindFrame;

  /**
   * Miserable Mind | http://www.miserablemind.com
   * mindFrame - Micro PHP Framework
   * The MIT License (MIT)
   */

/**
 * A Url Mapper that is a fully functional mapper and may be used as it is.
 */
class BaseUrlMapper
{

  private $namespacePrefix;
  private $urlVariables = array();

  public function __construct($namespacePrefix)
  {
    $this->namespacePrefix = $namespacePrefix;
  }

  //arrays for page -> controller

  private $exactPaths = array();
  private $partialPaths = array();

  /**
   * Public Method for matching path to a controller
   *
   * @param $pagePath
   * @return bool|string
   */
  public function getPageController($pagePath)
  {
    //look for exact path
    if (isset($this->exactPaths[$pagePath])) {
      return $this->exactPaths[$pagePath];
    }

    //try implicitly load
    if ($controller = $this->getImplicitMapping($pagePath)) {
      return $controller;
    }

    //look for partial path
    if ($controller = $this->getPartialMatch($pagePath)) {
      return $controller;
    }

    return false;
  }

  /**
   * Extracts :varNames from a registered partial route
   *
   * @param $routePath
   * @return array|mixed
   */
  protected function getPartialVarNames($routePath)
  {
    preg_match_all('/:.*?\\//', $routePath, $varMatches, 0);
    if ($varMatches && $varMatches = array_pop($varMatches)) {
      array_walk($varMatches, function (&$value) {
        $value = trim($value, '/:');
      });
      return $varMatches;
    }

    return array();
  }

  /**
   * Maps the variable keys to their values
   *
   * @param $pagePath
   * @param array $varValues
   * @return array
   */
  protected function  getPartialVarList($pagePath, array $varValues)
  {
    $urlVars = array();
    $varNames = $this->getPartialVarNames($pagePath);
    foreach ($varValues as $key => $value) {
      $urlVars[$varNames[$key]] = $value;
    }

    return $urlVars;

  }

  /**
   * Loops through registered partial matches till it finds one. Returns false if none found.
   *
   * @param $pagePath
   * @return bool
   */
  protected function getPartialMatch($pagePath)
  {
    if (substr($pagePath, -1, 1) != '/') $pagePath .= '/';

    $partials = $this->partialPaths;

    foreach ($partials as $partialPagePath => $controllerName) {

      if (substr($partialPagePath, -1, 1) != '/') $partialPagePath .= '/';

      $count = null;
      $noVariables = preg_replace('/:(.)*?\\//', '(.*)/', $partialPagePath, -1, $count);
      $pattern = '/^' . str_replace('/', '\/', $noVariables) . '$/';

      $matches = null;
      if (preg_match($pattern, $pagePath, $matches)) {
        //remove the full link from result
        array_shift($matches);
        $this->urlVariables = $this->getPartialVarList($partialPagePath, $matches);
        return $controllerName;
      }
    }

    return false;
  }


  /**
   * Maps a page to a controller. Keeps separate lists for exact and partial mappings
   *
   * @param $pagePath string url path
   * @param $controller string controller path with a namespace
   */
  public function addPage($pagePath, $controller)
  {
    if (strstr($pagePath, ':')) {
      $this->partialPaths[$pagePath] = $this->namespacePrefix . '\\' . $controller;
    }

    $this->exactPaths[$pagePath] = $this->namespacePrefix . $controller;
  }

  /**
   * Converts path to a controller, so no need to have an entry in routes if the url follows the convention
   * Example: www.example.com/user/sign-up would look for {$namespacePrefix}\user\SignUpController
   *
   * @param $pagePath string url of the page (except the domain part)
   * @return string controller name if found, null otherwise
   */
  protected function getImplicitMapping($pagePath)
  {
    $parts = explode('/', $pagePath);

    $lastPart = array_pop($parts);
    $words = explode('-', $lastPart);
    $controllerName = '';
    foreach ($words as $word) {
      $controllerName .= ucfirst(strtolower($word));
    }
    $controllerName .= 'Controller';
    $parts[] = $controllerName;

    $controller = $this->namespacePrefix . implode('\\', $parts);

    if (class_exists($controller)) {
      return $controller;
    }

    return null;

  }

  /**
   * Gets the variables extracted from a url path
   *
   * @return array
   */
  public function getUrlVariables()
  {
    return $this->urlVariables;
  }

}