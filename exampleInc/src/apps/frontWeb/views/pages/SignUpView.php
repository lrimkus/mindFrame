<?php

namespace exampleInc\apps\frontWeb\views\pages;

use exampleInc\apps\frontWeb\domain\forms\UserProfileForm;
use exampleInc\apps\frontWeb\domain\HtmlMetaData;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\elements\ProfileFormView;
use mindFrame\BasePageView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */
class SignUpView extends BasePageView
{

  const HTML_META_DESCRIPTION = 'Sign Up Page';
  const HTML_META_TITLE = 'Sign Up';
  const HTML_META_KEYWORDS = 'sign up, profile, user';

  private $profileFormView;

  /**
   * @param FrontWebModel $model
   * @param $userProfileForm UserProfileForm
   * @param $signUpFormActionUrl
   */
  public function __construct(FrontWebModel $model, $userProfileForm, $signUpFormActionUrl)
  {
    parent::__construct($model);
    $this->profileFormView = new ProfileFormView($model, $userProfileForm, $signUpFormActionUrl);
  }

  /**
   * @return HTMLMetaData
   */
  function getHTMLMetaData()
  {
    return new HtmlMetaData(self::HTML_META_TITLE, self::HTML_META_DESCRIPTION, self::HTML_META_KEYWORDS);
  }

  function getTemplateFileName()
  {
    return __DIR__ . '/../../templates/signup/tpl.signup.php';
  }

  /**
   * @return \exampleInc\apps\frontWeb\views\elements\ProfileFormView
   */
  public function getProfileFormView()
  {
    return $this->profileFormView;
  }
}