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
    $View->display();
  }
  
  /**
   * multiple page thingy
   * @return null
   */
  public function multipageAction()
  {
    $Request = Request::getInstance();
    $template = $Request->template;
      
    $pages = array (
     'intro' => 'Introducción',
     'mvc' => 'Model View Controller',
     'layer' => 'Good Cake, Bad Cake',
     'diagram_simplified' => 'Diagrama',
     'diagram' => 'Diagrama Extendido',
     'credits' => 'Creditos',
    );
    $links = '<p>';
    foreach($pages as $page =>$name ){
        $links .= "<a href=\"" . BASE_URL . "/index/multipage/?template=$page\">$name</a>  ";
    }
    $links .="</p>";
    
    $View = new View("index/$template");
    $View->assign('_title_', $pages[$template]);
    $View->assign('links', $links);
    $View->display();
  }
}
