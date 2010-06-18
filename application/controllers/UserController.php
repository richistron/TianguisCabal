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
    
    if ( $User->role=='new') {
      $this->gotoPage('/user/index', 'You must validate your email account first.');
    }
    //@todo Create a {@link Session} object to handle session stuff
    $_SESSION['user_id'] = $User->getId();
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
  
  public function logoutAction() {
    UserModel::logout();
    $this->gotoPage('/index', 'Succefully logged out');
  }

  public function newAction() {
    if ( $User = UserModel::getLoggedInUser() ) {
      $this->gotoPage('/index', 'You can\'t register being logged in');
    }
    $View= new View('user/new');
    $View->assign('_title_', _('New User') );
    $View->display();
  }
  
  public function saveAction() {
    
    $name = $_POST['name'];
    if ( UserModel::getByName($name) ) {
      $this->gotoPage('/user/new', 'That username is already taken');
    }
    
    $User             = new UserModel(0);
    $User->name       = $name;
    $User->password   = $_POST['password'];
    $User->full_name  = $_POST['full_name'];
    $User->email      = $_POST['email'];
    $User->date       = date("Y-m-d");
    
    $User->save();
    
    $Mailer = new Mailer();
    $Mailer->send($User->email, $User->full_name, 'Please validate your email account', 'Click Here');
    $this->gotoPage("/user/view/?user_id=$User->user_id", "User saved as: ". htmlspecialchars($User->name));
  }
}
