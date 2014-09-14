<?php

namespace exampleInc\apps\frontWeb\views;

use mindFrame\BaseView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class Navigation extends BaseView
{

  function getTemplateFileName()
  {
    return __DIR__ . "/../templates/tpl.navigation.php";
  }

}