<?php
/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/** @var $this LoginView */
use exampleInc\apps\frontWeb\controllers\login\LoginController;
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\pages\LoginView;

/** @var FrontWebModel $model */
$model = $this->getModel();
$errors = $model->getErrorMessages();
?>

<div>
  <?php foreach ($errors as $error): ?>
    <div class="error"><?= $error ?></div>
  <?php endforeach ?>
</div>

<form method="post" action="/login">
  <label>Username:
    <input name="<?= LoginController::AUTH_USER_NAME ?>"/>
  </label>
  <label>Password:
    <input name="<?= LoginController::AUTH_PASSWORD ?>" type="password"/>
  </label>
  <input type="submit"/>
</form>