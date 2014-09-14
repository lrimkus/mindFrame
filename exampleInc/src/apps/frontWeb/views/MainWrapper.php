<?php

namespace exampleInc\apps\frontWeb\views;

use exampleInc\apps\frontWeb\domain\HtmlMetaData;
use exampleInc\apps\frontWeb\FrontWebModel;
use mindFrame\BasePageView;
use mindFrame\BaseView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class MainWrapper extends BaseView
{

  private $nav;
  private $body;
  private $pageMetaData;

  public function __construct(FrontWebModel $model, BasePageView $body)
  {
    parent::__construct($model);
    $this->body = $body;
    $this->pageMetaData = $body->getHTMLMetaData();
  }

  public function getNav()
  {
    if (!$this->nav) $this->nav = new Navigation($this->getModel());
    return $this->nav;
  }

  /**
   * @return BaseView
   */
  public function getBody()
  {
    return $this->body;
  }

  function getTemplateFileName()
  {
    return __DIR__ . "/../templates/tpl.main.php";
  }

  /**
   * @return HtmlMetaData
   */
  public function getPageMetaData()
  {
    return $this->pageMetaData;
  }


}