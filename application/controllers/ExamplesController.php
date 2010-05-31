<?php
/**
 * Use Examples
 * @package TianguisCabal
 */
class ExamplesController extends controller
{
  /**
   * Hello World Example
   * @return null
   */
  public function indexAction()
  {
    $View = new View('examples/index');
    $View->assign('_title_', _('Home'));
    $View->display();
  }
  
  /**
   * Messages Example
   * @return null
   */
  public function messageAction()
  {
    $View = new View('examples/message');
    $View->assign('_title_', _('Message Examples'));
    $View->assign('_message_', "Ejemplo de como abrir un mensaje desde el controlador");
    $View->display();
  }
}
