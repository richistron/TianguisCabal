<?php
/**
 * Handles everything about the user
 * @package TianguisCabal
 */
class UserController extends controller
{
  
  public function indexAction()
  {
    $View = new View('user/index');
    $View->assign('_title_', _('Login'));
    $View->display();
  }
  
  public function loginAction()
  {
    if ( empty($_POST['name']) || empty($_POST['password']) ) {
      $this->gotoPage('/user/index', 'User or Password is Empty');
    }
    
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    if( !$User = UserModel::getByName($name) ) {
      $this->gotoPage('/user/index', 'That user doesn\'t exists');
    }
    
    $User->load();
    
    if ( !$User->validatePassword($password) ) {
      $this->gotoPage('/user/index', 'The password is wrong');
    }
    
    //@todo Create a {@link Session} object to handle session stuff
    $_SESSION['logged_as'] = $User->getId();
    $this->gotoPage("/user/view/?user_id=$User->user_id", "You had logged in as ". htmlspecialchars($User->name));
  }
  
  public function viewAction() {
    $View = new View('user/view');
    $View->assign('_title_', _('User Detail'));
    $Request = Request::getInstance();
    $user_id = $Request->user_id;
    
    $User = new UserModel((int)$user_id);
    $User->load();
    
    $View->assign('User', $User);
    $View->display();
  }
  
}
