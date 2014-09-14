<?php

use exampleInc\apps\frontWeb\controllers\user\SignUpController;
use exampleInc\apps\frontWeb\domain\forms\UserProfileForm;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\elements\ProfileFormView;

/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/** @var $this ProfileFormView */

/** @var $userProfileForm UserProfileForm */
$userProfileForm = $this->getUserProfileForm();

/** @var FrontWebModel $model */
$model = $this->getModel();

/** @var String[] $errorMessages */
$errorMessages = $model->getErrorMessages();

?>

<?php if ($errorMessages): ?>
  <div>
    <b>The Data you entered had some errors. Please fix them and try again:</b>
  </div>
  <?php foreach ($errorMessages as $error): ?>
    <div><?= $error ?></div>
  <?php endforeach ?>
<?php endif ?>


<form method="post" action="<?= $this->getFormActionUrl() ?>">

  <div>
    <label>First Name
      <input name="<?= SignUpController::REQUEST_FIRST_NAME ?>"
             value="<?= ($userProfileForm) ? $userProfileForm->getFirstName() : '' ?>"/>
    </label>
  </div>

  <div>
    <label>Last Name
      <input name="<?= SignUpController::REQUEST_LAST_NAME ?>" value="<?=
      ($userProfileForm) ? $userProfileForm->getLastName() : '' ?>"/>
    </label>
  </div>

  <div>
    <label>User Name
      <input name="<?= SignUpController::REQUEST_USER_NAME ?>" value="<?=
      ($userProfileForm) ? $userProfileForm->getUserName() : '' ?>"/>
    </label>
  </div>
  <div>
    <label>E-mail
      <input name="<?= SignUpController::REQUEST_EMAIL ?>" value="<?=
      ($userProfileForm) ? $userProfileForm->getEmail() : '' ?>"/>
    </label>
  </div>
  <div>
    <label>Password
      <input name="<?= SignUpController::REQUEST_PASSWORD ?>" type="password"/>
    </label>
  </div>
  <input type="Submit" value="Submit">
</form>