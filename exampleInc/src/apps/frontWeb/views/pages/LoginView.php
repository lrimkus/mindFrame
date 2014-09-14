<?php

namespace exampleInc\apps\frontWeb\views\pages;

use exampleInc\apps\frontWeb\domain\HtmlMetaData;
use mindFrame\BasePageView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class LoginView extends BasePageView
{

  const HTML_META_TITLE = 'Home Page';
  const HTML_META_DESCRIPTION = 'MindFrame - Another PHP micro framework';
  const HTML_META_KEYWORDS = 'php, framework, home';

  function getTemplateFileName()
  {
    return __DIR__ . '/../../templates/login/tpl.login.php';
  }

  /**
   * @return HTMLMetaData
   */
  function getHTMLMetaData()
  {
    return new HtmlMetaData(self::HTML_META_TITLE, self::HTML_META_DESCRIPTION, self::HTML_META_KEYWORDS);
  }
}