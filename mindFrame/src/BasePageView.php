<?php

namespace mindFrame;

  /**
   * Miserable Mind | http://www.miserablemind.com
   * mindFrame - Micro PHP Framework
   * The MIT License (MIT)
   */

/**
 * An abstract class for a full page view. Incomplete HTML pages should not extend this, they should extend BaseView
 */
abstract class BasePageView extends BaseView
{

  /**
   * Returns Meta Data for html Meta and Title tags
   * This method is essential for complete page views as it gets called from the wrapper for HTML meta data
   *
   * @return mixed
   */
  abstract function getHTMLMetaData();

}