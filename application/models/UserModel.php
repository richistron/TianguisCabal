<?php
/**
 * Extends DAO to provide User Specific functionality
 * @author Argel Arias <levhita@gmail.com>
 * @package TianguisCabal
 */
class UserModel extends DAO {
  
  /**
   * holds the current logged in user
   * @var UserModel
   */
  private static $__logged_user = NULL;
  
  public function __construct($id)
  {
    parent::__construct('user', (int)$id);
  }
  
  /**
   * Gets All Users
   * @return array
   */
  public static function getAll()
  {
    $sql = 'SELECT * FROM user';
    $DbConnection = DbConnection::getInstance();
    return $DbConnection->getAll($sql);
  }
  
  /**
   * Gets a {@link UserModel} from the unique user.name
   * @param string $name
   * @return UserModel
   */
  public static function getByName($name)
  {
    $sql = "SELECT user_id
            FROM user
            WHERE name='" . mysql_escape_string($name) . "'
            LIMIT 1;";
    $DbConnection = DbConnection::getInstance();
    if ( !$user_id = $DbConnection->getOne($sql) ) {
      return false;
    }
    return new UserModel($user_id);
  }
  
  /**
   * If there is valid user logged in it returns a loaded instance of it
   * @return UserModel If there is a valid logged in user, false otherwise
   */
  public static function getLoggedInUser()
  {
    if ( !isset($_SESSION['user_id']) ){
      return false;
    }
    $user_id = (int)$_SESSION['user_id'];
    if ( !self::$__logged_user instanceof self ) {
      self::$__logged_user = new self($user_id);
    }
    if ( !self::$__logged_user->isLoaded() ){
      if ( !self::$__logged_user->load() ) {
        unset($_SESSION['user_id']);
        unset(self::$__logged_user);
        return false;
      }
    }
    return self::$__logged_user;
  }
  
  /**
   * Cleans the logged in user from the session and current static instance
   * @return void
   */
  public static function logout()
  {
    unset($_SESSION['user_id']);
    self::$__logged_user = NULL;
  }
  
  /**
   * Validates if the given password match the password in the database
   * @param string $password
   * @return Boolean true on valid password, false otherwise
   */
  public function validatePassword($password)
  {
    $this->assertLoaded();
    return ( sha1($password) == $this->_data['password'] );
  }
  
  public function validateCode($code) {
    return ($code === $this->generateCode() );
  }
  
  public function generateCode(){
    $this->assertLoaded();
    $Config = $Config = Config::getInstance();
    return sha1($this->email + $this->name + $Config->salt);
  }
}
