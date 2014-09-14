<?php
/*
 * Miserable Mind
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * Entry point for the app. Calls the bootstrap. It needs to require files because auto loader is still not loaded.
 */

session_start();
require_once "../../../../mindFrame/src/BaseBootstrap.php";
require_once "../../../src/apps/frontWeb/FrontBootstrap.php";
$bootStrap = new \exampleInc\apps\frontWeb\FrontBootstrap();
$bootStrap->main();