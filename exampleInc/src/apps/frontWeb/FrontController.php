<?php

namespace exampleInc\apps\frontWeb;

use exampleInc\apps\frontWeb\views\MainWrapper;
use exampleInc\model\user\User;
use exampleInc\model\user\UserManager;
use mindFrame\BaseController;
use mindFrame\BasePageView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Parent Class for every controller in the app
 */
abstract class FrontController extends BaseController
{

  /** @var  FrontWebIOC */
  protected $ioc;

  const SESSION_USER_ID = 'user_id';

  const ERROR_GENERAL_MYSQL = "An Error Happened On Our End. Please try again later.";

  protected $activeUser;

  /**
   * 302 redirect
   *
   * @param $location - location where the visitor should be redirected.
   * @return bool
   */
  public function redirect($location)
  {
    header("Location: " . $location);
    return false;
  }

  /**
   * Sends a 500 header in case of server side problem. It does not exit, so rendeing of the page can be completed.
   */
  public function send500Header()
  {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  }

  /**
   * This is used only by preHandle to populate the user in the model. In the app it should aways be retrieved from the model.
   *
   * @return User|null
   */
  private function getUser()
  {
    $userId = !empty($_SESSION[self::SESSION_USER_ID]) ? $_SESSION[self::SESSION_USER_ID] : null;

    if (!$userId) return null;

    if ($this->activeUser) {
      return $this->activeUser;
    }

    /** @var UserManager $userManager */
    $userManager = $this->ioc->getUserManager();
    $user = $userManager->getUserById($userId);

    return $this->activeUser = $user;
  }

  public function setUser(User $activeUser)
  {
    $this->activeUser = $activeUser;
  }


  /**
   * PreHandle for every controller. In this case it pre-populates the model with certain data.
   *
   * @param FrontWebModel $model
   * @param $needsLogIn
   * @return bool|mixed
   */
  public function preHandle($model)
  {
    $model->setActiveUser($this->getUser());
    $model->setAppProperties($this->ioc->getAppProperties());
    return true;
  }

  /**
   * Happens after handleRequest. This app does not need anything here yet.
   *
   * @param FrontWebModel $model
   * @return bool
   */
  public function postHandle($model)
  {
    return true;
  }

  /**
   * Renders a template with the MainWrapper.
   *
   * @param FrontWebModel $model
   * @param BasePageView $pageView
   */
  public function renderMainTemplate(FrontWebModel $model, BasePageView $pageView)
  {
    $template = new MainWrapper($model, $pageView);
    echo $template->render();
  }

}