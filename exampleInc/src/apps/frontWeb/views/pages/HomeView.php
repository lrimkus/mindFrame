<?php

namespace exampleInc\apps\frontWeb\views\pages;

use exampleInc\apps\frontWeb\domain\HtmlMetaData;
use exampleInc\apps\frontWeb\FrontWebModel;
use mindFrame\BasePageView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class HomeView extends BasePageView
{

  const HTML_META_TITLE = 'Home Page';
  const HTML_META_DESCRIPTION = 'MindFrame - Another PHP micro framework';
  const HTML_META_KEYWORDS = 'php, framework, home';

  public function __construct(FrontWebModel $model)
  {
    parent::__construct($model);
  }

  function getTemplateFileName()
  {
    return __DIR__ . '/../../templates/home/tpl.home.php';
  }

  /**
   * @return HTMLMetaData
   */
  function getHTMLMetaData()
  {
    return new HtmlMetaData(self::HTML_META_TITLE, self::HTML_META_DESCRIPTION, self::HTML_META_KEYWORDS);
  }
}