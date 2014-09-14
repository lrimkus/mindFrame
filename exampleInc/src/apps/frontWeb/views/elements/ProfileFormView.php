<?php

namespace exampleInc\apps\frontWeb\views\elements;

use exampleInc\apps\frontWeb\domain\forms\UserProfileForm;
use mindFrame\BaseView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class ProfileFormView extends BaseView
{

  private $userProfileForm;
  private $formActionUrl;

  public function __construct($model, $userProfileForm, $formActionUrl)
  {
    parent::__construct($model);
    $this->userProfileForm = $userProfileForm;
    $this->formActionUrl = $formActionUrl;
  }

  function getTemplateFileName()
  {
    return __DIR__ . "/../../templates/profile/tpl.profile-form.php";
  }

  /**
   * @return UserProfileForm
   */
  public function getUserProfileForm()
  {
    return $this->userProfileForm;
  }

  /**
   * @return String
   */
  public function getFormActionUrl()
  {
    return $this->formActionUrl;
  }

}