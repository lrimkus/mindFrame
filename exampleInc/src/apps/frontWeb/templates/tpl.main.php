<?php
/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/** @var $this MainWrapper */
use exampleInc\apps\frontWeb\FrontWebModel;
use exampleInc\apps\frontWeb\views\MainWrapper;

/** @var FrontWebModel $model */
$model = $this->getModel();
$meta = $this->getPageMetaData();
?>
<html>
<head>
  <title><?= $model->getAppProperties()->getAppName() ?> - <?= $meta->getTitle() ?></title>
  <link rel="shortcut icon" href="/img/favicon.ico"/>
  <meta name="description" content="<?= $meta->getDescription() ?>"/>
  <meta name="keywords" content="<?= $meta->getKeywords() ?>"/>
</head>
<body>
<?= $this->getNav()->render() ?>
<div id="main-container">
  <?= $this->getBody()->render() ?>
</div>
</body>
</html>