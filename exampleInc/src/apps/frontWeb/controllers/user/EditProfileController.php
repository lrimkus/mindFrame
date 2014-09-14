<?php

namespace exampleInc\apps\frontWeb\controllers\user;

use exampleInc\apps\frontWeb\domain\forms\UserProfileForm;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\pages\EditProfileView;
use exampleInc\model\user\UserManager;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class EditProfileController extends UserFormController
{

  const ACTION_URL = "/user/edit-profile";

  /**
   * If User Is Not Logged In, redirect to log in
   *
   * @param FrontWebModel $appModel
   * @return bool|mixed
   */
  public function preHandle($appModel)
  {
    if (!parent::preHandle($appModel)) return false;
    if (!$appModel->getActiveUser()) {
      $this->redirect("/login");
      return false;
    }

    return true;
  }

  /**
   * Renders an edit profile page with a user information
   *
   * @param $appModel FrontWebModel
   * @return bool|void
   */
  protected function handleGet($appModel)
  {
    $user = $appModel->getActiveUser();
    $userProfileForm = new UserProfileForm($user->getEmail(), $user->getFirstName(), $user->getLastName(), null, $user->getUserName());
    $this->renderPage($appModel, $userProfileForm);
  }

  /**
   * Updates user info, if valid, otherwise renders a page with form errors and sends 500 header
   *
   * @param FrontWebModel $appModel
   * @param UserManager $userManager
   * @param UserProfileForm $userProfileForm
   * @return bool
   */
  protected function writeData(FrontWebModel $appModel, UserManager $userManager, UserProfileForm $userProfileForm)
  {

    $user = $userManager->updateUser(
        $appModel->getActiveUser()
        , $userProfileForm->getFirstName()
        , $userProfileForm->getLastName()
        , $userProfileForm->getUserName()
        , $userProfileForm->getEmail()
        , $userProfileForm->getPassword()
    );

    if (!$user) {
      $this->send500Header();
      $appModel->addErrorMessage(self::ERROR_GENERAL_MYSQL);
      $this->renderPage($appModel, $userProfileForm);
      return false;
    }

    $this->setUser($user);
    $this->redirect(self::ACTION_URL);
    return true;

  }


  /**
   * Renders a page with Edit Profile view that is filled out with data from UserProfileForm
   *
   * @param FrontWebModel $appModel
   * @param UserProfileForm $userProfileForm
   * @return void
   */
  protected function renderPage(FrontWebModel $appModel, $userProfileForm)
  {
    $pageView = new EditProfileView($appModel, $userProfileForm, self::ACTION_URL);
    $this->renderMainTemplate($appModel, $pageView);
  }


}