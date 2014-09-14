<?php

namespace exampleInc\apps\frontWeb\controllers\login;

use exampleInc\apps\frontWeb\FrontController;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\pages\LoginView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class LoginController extends FrontController
{

  const AUTH_USER_NAME = 'auth_user_name';
  const AUTH_PASSWORD = 'auth_password';
  const ERROR_BAD_CREDENTIALS = 'Wrong Username and/or Password';

  /**
   * @param FrontWebModel $appModel
   * @return bool
   */
  public function handleRequest($appModel)
  {
    if ($appModel->getActiveUser()) return $this->redirect("/");

    return (!empty($_POST)) ? $this->handlePost($appModel) : $this->handleGet($appModel);
  }

  /**
   * Handles form POST from registration page - registers and logs in a user if valid
   *
   * @param FrontWebModel $appModel
   * @return bool
   */
  protected function handlePost(FrontWebModel $appModel)
  {
    $username = $this->getRequestParam(self::AUTH_USER_NAME);
    $password = $this->getRequestParam(self::AUTH_PASSWORD);

    if (!$username || !$password) {
      $appModel->addErrorMessage(self::ERROR_BAD_CREDENTIALS);
      $this->renderPage($appModel);
      return false;
    }

    $userManager = $this->ioc->getUserManager();
    $user = $userManager->getUserByLogInAndPassword($username, $password);

    if (!$user) {
      $appModel->addErrorMessage(self::ERROR_BAD_CREDENTIALS);
      $this->renderPage($appModel);
      return false;
    }

    //log the user in
    $_SESSION[self::SESSION_USER_ID] = $user->getId();
    $this->setUser($user);

    return $this->redirect("/");

  }

  /**
   * Handles Get. In this case it only renders the template with a Log In form.
   *
   * @param $appModel FrontWebModel
   * @return bool
   */
  protected function handleGet($appModel)
  {
    return $this->renderPage($appModel);
  }

  /**
   * Renders a page with a LoginView module
   *
   * @param $appModel FrontWebModel
   * @return bool
   */
  private function renderPage($appModel)
  {
    $this->renderMainTemplate($appModel, new LoginView($appModel));
    return true;
  }


}