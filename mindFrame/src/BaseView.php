<?php

namespace mindFrame;

  /**
   * Miserable Mind | http://www.miserablemind.com
   * mindFrame - Micro PHP Framework
   * The MIT License (MIT)
   */

/**
 * The Base View class serves as a parent for views.
 * The construct requires the needed data for the template.
 * In this way it defines a contract between a template and a controller.
 */
abstract class BaseView
{

  private $model;

  /**
   * @param $model BaseModel
   */
  function __construct($model)
  {
    $this->model = $model;
  }

  /**
   * Assembles html from a template file and returns it.
   * The calling method is responsible for outputting it.
   *
   * @return string
   */
  public function render()
  {
    ob_start();
    include $this->getTemplateFileName();
    return ob_get_clean();
  }

  /**
   * Every view has to have a template file associated with it.
   *
   * @return string
   */
  abstract function getTemplateFileName();

  /**
   * View Files have a model reference in them as some of the model getters need to be called in templates.
   *
   * @return BaseModel
   */
  public function getModel()
  {
    return $this->model;
  }

}