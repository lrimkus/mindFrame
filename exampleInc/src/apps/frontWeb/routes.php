<?php
/**
 * Miserable Mind | http://www.miserablemind.com
 * mindFrame - Micro PHP Framework
 * The MIT License (MIT)
 */

/**
 * A file to register routes. Uses BaseUrlMapper for this app.
 * BaseUrlMapper matches paths to controllers in three ways for now:
 * 1. Exact Explicit. Url Path is added here via addPage.
 *    Example: $urlMapper->addPage('sign-up', 'user\SignUpController'); /sign-up will lead to user\SignUpController
 * 2. Exact Implicit. Controller path follows convention and no need to register it here. See BaseUrlMapper.
 *    Example: /user/edit-profile is mapped to {prefix}\user\EditProfileController
 * 3. Partial Explicit. Register a path with :variables in it and map it to a controller.
 *    Example: $urlMapper->addPage('product/:productId/description', 'product\ProductController');
 *    Product Id in controller can be retrieved by $this->getURLMatchedVariable('productId');
 */

/**
 * @var $urlMapper BaseUrlMapper
 */
use mindFrame\BaseUrlMapper;

$urlMapper->addPage('', 'home\HomeController');
$urlMapper->addPage('sign-up', 'user\SignUpController');
$urlMapper->addPage('login', 'login\LoginController');
$urlMapper->addPage('logout', 'login\LogOutController');

//No need to add edit-profile as it is being loaded implicitly as it follows the convention
#$urlMapper->addPage('edit-profile', 'user\EditProfileController');
