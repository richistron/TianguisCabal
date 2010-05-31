<?php
/**
 * Presentation Concept for the FrameWork
 * @package TianguisCabal
 */
class ConceptController extends controller
{
  /**
   * multiple page thingy
   * @return null
   */
  public function indexAction()
  {
    $Request = Request::getInstance();
    $template = ( !isset($Request->template) )? 'index': $Request->template;
      
    $pages = array (
     'index' => 'Introducción',
     'mvc' => 'Model View Controller',
     'layer' => 'Good Cake, Bad Cake',
     'diagram_simplified' => 'Diagrama',
     'diagram' => 'Diagrama Extendido',
     'credits' => 'Creditos',
    );
    $links = '<p>';
    foreach($pages as $page =>$name ){
        $links .= "<a href=\"" . BASE_URL . "/concept/?template=$page\">$name</a>  ";
    }
    $links .="</p>";
    
    $View = new View("concept/$template");
    $View->assign('_title_', $pages[$template]);
    $View->assign('links', $links);
    $View->display();
  }
}
