<?php

namespace exampleInc\apps\frontWeb\controllers\user;

use exampleInc\apps\frontWeb\domain\forms\UserProfileForm;
use exampleInc\apps\frontWeb\FrontController;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\model\user\UserManager;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Abstract class that keeps the common functionality for registering and updating user info.
 */
abstract class UserFormController extends FrontController
{

  const REQUEST_FIRST_NAME = 'first_name';
  const REQUEST_LAST_NAME = 'last_name';
  const REQUEST_USER_NAME = 'username';
  const REQUEST_EMAIL = 'email';
  const REQUEST_PASSWORD = 'password';

  const ERROR_USERNAME_TAKEN = 'This Username Is Taken';
  const ERROR_EMAIL_TAKEN = 'This E-mail Is Taken';


  /**
   * Determines if its POST or GET and calls the appropriate methods
   *
   * @param FrontWebModel $appModel
   * @return bool
   */
  public function handleRequest($appModel)
  {
    return (!empty($_POST)) ? $this->handlePost($appModel) : $this->handleGet($appModel);
  }


  /**
   * Validates and updates the data in persistence layer
   *
   * @param $appModel FrontWebModel
   * @return bool
   */
  protected function handlePost($appModel)
  {
    $userManager = $this->ioc->getUserManager();

    $userProfileForm = new UserProfileForm(
        $this->getRequestParam(self::REQUEST_EMAIL)
        , $this->getRequestParam(self::REQUEST_FIRST_NAME)
        , $this->getRequestParam(self::REQUEST_LAST_NAME)
        , $this->getRequestParam(self::REQUEST_PASSWORD)
        , $this->getRequestParam(self::REQUEST_USER_NAME)
    );

    if ($this->validateForm($appModel, $userProfileForm, $userManager) === false) {
      return false;
    }

    return $this->writeData($appModel, $userManager, $userProfileForm);
  }

  /**
   * Form  Data validation for creating and updating new user
   *
   * @param $appModel FrontWebModel
   * @param UserProfileForm $userProfileForm
   * @param UserManager $userManager
   * @return bool
   */
  protected function validateForm($appModel, UserProfileForm $userProfileForm, UserManager $userManager)
  {
    $formErrors = $userProfileForm->getErrorMessages();

    //validate the form
    if (!empty($formErrors)) {
      $appModel->addErrorMessages($formErrors);
      $this->renderPage($appModel, $userProfileForm);
      return false;
    }

    //check if unique email and unique username

    $activeUser = $appModel->getActiveUser();

    if ($userManager->getUserByUsername($userProfileForm->getUserName()) //username is taken
        && (!$activeUser || $activeUser->getUserName() != $userProfileForm->getUserName()) //and username doesn't belong to a current user
    ) {
      $appModel->addErrorMessage(self::ERROR_USERNAME_TAKEN);
      $this->renderPage($appModel, $userProfileForm);
      return false;
    }

    if ($userManager->getUserByEmail($userProfileForm->getEmail()) //e-mail is taken
        && (!$activeUser || $activeUser->getEmail() != $userProfileForm->getEmail()) //and e-mail doesn't belong to a current user
    ) {
      $appModel->addErrorMessage(self::ERROR_EMAIL_TAKEN);
      $this->renderPage($appModel, $userProfileForm);
      return false;
    }

    return true;

  }

  /**
   * Handles The GET part of controller
   *
   * @param $appModel
   * @param $userProfileForm UserProfileForm
   * @return bool
   */
  protected abstract function handleGet($appModel);

  /**
   * Sends new data to persistence layer
   *
   * @param FrontWebModel $appModel
   * @param UserManager $userManager
   * @param UserProfileForm $userProfileForm
   * @return mixed
   */
  protected abstract function writeData(FrontWebModel $appModel, UserManager $userManager, UserProfileForm $userProfileForm);

  /**
   * Prepare the view and render the page
   *
   * @param FrontWebModel $model
   * @param UserProfileForm $userProfileForm
   * @return mixed
   */
  protected abstract function renderPage(FrontWebModel $model, $userProfileForm);


}