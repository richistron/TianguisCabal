<?php
/**
 * Main Controller, the one that gets shown when you don't send any parameter
 * @package TianguisCabal
 */
class IndexController extends controller
{
  /**
   * Hello World Example
   * @return null
   */
  public function indexAction()
  {
    $View = new View('index/index');
    $View->assign('_title_', _('Home'));
    $View->assign('message', "Hello World");
    $View->display();
  }
  
  /**
   * Messages Example
   * @return null
   */
  public function messageAction()
  {
    $View = new View('index/message');
    $View->assign('_title_', _('Message Examples'));
    $View->assign('_message_', "Ejemplo de como abrir un mensaje desde el controlador");
    $View->display();  }
}
