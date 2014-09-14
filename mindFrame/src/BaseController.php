<?php

namespace mindFrame;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

abstract class BaseController
{
  private $urlMatchedVariables = array();

  protected $ioc;

  function __construct(BaseIOC $ioc, $urlMatchedVariables)
  {
    $this->ioc = $ioc;
    $this->urlMatchedVariables = $urlMatchedVariables;
  }

  /**
   * First method that gets called in controller. Must return true to continue processing request.
   *
   * @param BaseModel $model
   * @return mixed
   */
  abstract function preHandle($model);

  /**
   * Main method of the controller. Gets called after a successful preHandle()
   * @param BaseModel $model
   * @return mixed
   */
  abstract function handleRequest($model);

  /**
   * This gets called to finalize the request. Does not get called if handleRequest throws error.
   *
   * @param BaseModel $model
   * @return mixed
   */
  abstract function postHandle($model);

  /**
   * Sends a proper json response. Useful for AJAX.
   *
   * @param array $data
   * @param bool $success
   */
  protected function sendJSONResponse($data, $success = true)
  {
    header('Content-type: application/json');
    $response = array('success' => $success, 'data' => $data);
    echo json_encode($response);
  }

  protected function getURLMatchedVariables()
  {
    return $this->urlMatchedVariables;
  }

  protected function getURLMatchedVariable($varName)
  {
    if (isset($this->urlMatchedVariables[$varName])) {
      return $this->urlMatchedVariables[$varName];
    }
    return null;
  }

  /**
   * A shortcut to extract a request parameter
   *
   * @param $param $_REQUEST parameter
   * @return null or the parameter
   */
  protected function getRequestParam($param)
  {
    return !empty($_REQUEST[$param]) ? $_REQUEST[$param] : null;
  }

}