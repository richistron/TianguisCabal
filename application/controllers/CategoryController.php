<?php
/**
 * CRUD for Categories
 * @package TianguisCabal
 * @author Argel Arias <levhita@gmail.com>
 */
class CategoryController extends Controller {

  public function indexAction(){
   
    $View = new View('category/list');
    $View->assign('_title_', _('Categories'));
    
    $categories = CategoryModel::getAll();
    $View->assign('categories', $categories);
    
    $View->display();
  }
  
  public function viewAction(){
    $Request = Request::getInstance();
    
    $View = new View('category/view');
    $View->assign('_title_', _('View Category'));
    
    $id = ( isset($Request->id) )?(int)$Request->id:0;
    
    $Category = new CategoryModel($id);
    
    if ( !$Category->load() ) {
      $_SESSION['_MESSAGE_'] = _('That Category doesn\'t exists');
      header('Location: ' . BASE_URL . '/category');
      exit();
    }
    
    $View->assign('Category', $Category);
    $View->display();
  }
  
  public function editAction(){
    $Request = Request::getInstance();
    
    $View = new View('category/edit');
    $View->assign('_title_', _('Edit Category'));
    
    $id = ( isset($Request->id) )?(int)$Request->id:0;
    $Category = new CategoryModel($id);
    $Category->load();
    
    $View->assign('Category', $Category);
    $View->display();
  }
  
  /**
   *
   * @return unknown_type
   * @todo $_POST shouldn't be used, check how this can be integrated with {@link Request}
   */
  public function saveAction(){
    $View = new View('category/edit');
    $View->assign('_title_', _('View Category'));
    
    $id = ( isset($_POST['CatID']) )?(int)$_POST['CatID']:0;
    
    $Category = new CategoryModel($id);
    $Category->load();
    
    $Category->Categoria = $_POST['Categoria'];
    if ( !$Category->save() ) {
      $_SESSION['_MESSAGE_'] = _('Couldn\'t save Category');
      header('Location: ' . BASE_URL . '/category');
      exit();
    }
    
    $_SESSION['_MESSAGE_'] = _('Saved');
    if ( $id == 0 ) {
      $DbConnection=DbConnection::getInstance();
      $id = $DbConnection->getLastId();
    }
    header('Location: ' . BASE_URL . "/category/view/?id=$id");
  }
  
  public function deleteAction() {
    $Request = Request::getInstance();
    $id = ( isset($Request->id) )?(int)$Request->id:0;
    
    $Category = new CategoryModel($id);
    
    if ( !$Category->load() ) {
      $_SESSION['_MESSAGE_'] = _('That Category doesn\'t exists');
      header('Location: ' . BASE_URL . '/category');
      exit();
    }
    
    if ( !$Category->delete() ) {
      $_SESSION['_MESSAGE_'] = _('Couldn\'t delete Category');
      header('Location: ' . BASE_URL . '/category');
      exit();
    }
    
    $_SESSION['_MESSAGE_'] = _('Deleted');
    header('Location: ' . BASE_URL . '/category');
    exit();
    
    
  }
}