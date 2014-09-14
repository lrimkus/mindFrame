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
class EditProfileView extends BasePageView
{

  const HTML_META_TITLE = 'Edit Profile';
  const HTML_META_DESCRIPTION = 'Edit Profile Page';
  const HTML_META_KEYWORDS = 'profile, edit, user';

  private $profileFormView;

  public function __construct(FrontWebModel $model, UserProfileForm $userProfileForm, $editFormActionUrl)
  {
    parent::__construct($model);
    $this->profileFormView = new ProfileFormView($model, $userProfileForm, $editFormActionUrl);
  }

  /**
   * @return ProfileFormView
   */
  public function getProfileFormView()
  {
    return $this->profileFormView;
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
    return __DIR__ . '/../../templates/profile/tpl.edit-profile.php';
  }
}