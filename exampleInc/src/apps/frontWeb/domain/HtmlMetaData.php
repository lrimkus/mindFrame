<?php

namespace exampleInc\apps\frontWeb\domain;

  /**
   * Miserable Mind | http://www.miserablemind.com
   * mindFrame - Micro PHP Framework
   * The MIT License (MIT)
   */

/**
 * Class that holds META data for HTML Pages.
 */
class HtmlMetaData
{

  private $title;
  private $description;
  private $keywords;

  function __construct($title = null, $description = null, $keywords = null)
  {
    $this->description = $description;
    $this->keywords = $keywords;
    $this->title = $title;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setKeywords($keywords)
  {
    $this->keywords = $keywords;
  }

  public function getKeywords()
  {
    return $this->keywords;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getTitle()
  {
    return $this->title;
  }

}