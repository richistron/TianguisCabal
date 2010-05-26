<?php
/**
 * @package Garson
 * @author Argel Arias <levhita@gmail.com>
 */
class Controller
{
  /**
   * Our Request Object
   * @var Request
   */
  protected $_request = null;
  /**
   * @return Controller
   */
  public function __construct(){
    $this->_request = Request::getInstance();
  }
}