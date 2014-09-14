<?php
/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/** @var $this HomeView */
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\pages\HomeView;

/** @var FrontWebModel $model */
$model = $this->getModel();
$user = $model->getActiveUser();
?>
<h1>User</h1>
<?= ($user) ? $user->getUserName() : "No User" ?>
