<?php

namespace exampleInc\apps\frontWeb\controllers\user;

use exampleInc\apps\frontWeb\domain\forms\UserProfileForm;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\pages\SignUpView;
use exampleInc\model\user\UserManager;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class SignUpController extends UserFormController
{

  const ACTION_URL = "/sign-up";

  /**
   * If User Is Already Logged In, redirect to home page
   *
   * @param FrontWebModel $appModel
   * @return bool
   */
  public function preHandle($appModel)
  {
    if (!parent::preHandle($appModel)) return false;

    if ($appModel->getActiveUser()) {
      $this->redirect("/");
      return false;
    }

    return true;
  }

  /**
   * Handles get. Sign Up form is never pre-filled on GET, so it passes a null
   *
   * @param $appModel
   * @return bool
   */
  protected function handleGet($appModel)
  {
    $this->renderPage($appModel, null);
    return true;
  }

  /**
   * Registers a new user if valid, otherwise renders a page with form errors and sends 500 header
   *
   * @param FrontWebModel $appModel
   * @param UserManager $userManager
   * @param UserProfileForm $userProfileForm
   * @return bool
   */
  protected function writeData(FrontWebModel $appModel, UserManager $userManager, UserProfileForm $userProfileForm)
  {

    $user = $userManager->registerUser(
        $userProfileForm->getFirstName()
        , $userProfileForm->getLastName()
        , $userProfileForm->getUserName()
        , $userProfileForm->getEmail()
        , $userProfileForm->getPassword()
    );

    if ($user) {
      $_SESSION[self::SESSION_USER_ID] = $user->getId();
      $this->setUser($user);

      $this->redirect("/");
      return true;
    }

    //in case failed to insert
    $this->send500Header();
    $appModel->addErrorMessage(self::ERROR_GENERAL_MYSQL);
    $this->renderPage($appModel, $userProfileForm);
    return false;

  }

  /**
   * Renders Page with SignUpView that has an empty form if new, or pre-filled form and error messages if the submit failed
   *
   * @param FrontWebModel $appModel
   * @param UserProfileForm $userProfileForm
   * @return void
   */
  protected function renderPage(FrontWebModel $appModel, $userProfileForm)
  {
    $this->renderMainTemplate($appModel, new SignUpView($appModel, $userProfileForm, self::ACTION_URL));
  }
}