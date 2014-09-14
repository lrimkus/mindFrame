<?php

namespace exampleInc\apps\frontWeb\controllers\login;

use exampleInc\apps\frontWeb\FrontController;
use exampleInc\apps\frontWeb\FrontWebModel;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class LogOutController extends FrontController
{

  /**
   * Logs out a user and removes user_id from session
   *
   * @param FrontWebModel $appModel
   * @return bool
   */
  public function handleRequest($appModel)
  {
    unset($_SESSION[LoginController::SESSION_USER_ID]);

    $appModel->setActiveUser(null);

    return $this->redirect("/");
  }

}