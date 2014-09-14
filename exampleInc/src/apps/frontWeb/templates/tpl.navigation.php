<?php
/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/** @var $this Navigation */
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\Navigation;

/** @var FrontWebModel $model */
$model = $this->getModel();
?>

<div>
  <ul style="list-style: none">
    <li><a href="/">Home</a></li>
    <?php if ($model->getActiveUser()): ?>
      <li><a href="/user/edit-profile">Edit Profile</a></li>
      <li><a href="/logout">Log Out</a></li>
    <?php else: ?>
      <li><a href="/login">Log In</a></li>
      <li><a href="/sign-up">Sign Up</a></li>
    <?php endif ?>
  </ul>
</div>