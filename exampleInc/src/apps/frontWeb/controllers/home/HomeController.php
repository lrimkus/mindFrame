<?php

namespace exampleInc\apps\frontWeb\controllers\home;

use exampleInc\apps\frontWeb\FrontController;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\pages\HomeView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class HomeController extends FrontController
{

  /**
   * Home page. The only thing it does it renders the template for now.
   *
   * @param FrontWebModel $appModel
   * @return void
   */
  public function handleRequest($appModel)
  {
    $view = new HomeView($appModel);
    $this->renderMainTemplate($appModel, $view);
  }

}