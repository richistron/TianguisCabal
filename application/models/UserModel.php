<?php
/**
 * Extends DAO to provide User Specific functionality
 * @author Argel Arias <levhita@gmail.com>
 * @package TianguisCabal
 */
class UserModel extends DAO {
  
  public function __construct($id){
    parent::__construct('user', (int)$id);
  }
  
  /**
   * Gets All Categories
   * @return array
   */
  public static function getAll()
  {
    $sql = 'SELECT * FROM user';
    $DbConnection = DbConnection::getInstance();
    return $DbConnection->getAll($sql);
  }
  
  /**
   * Validates if the given password match the password in the database
   * @param string $password
   * @return Boolean true on valid password, false otherwise
   */
  public function validatePassword($password) {
    $this->assertLoaded();
    if ( sha1($password) == $this->password ) {
      return true;
    }
    return false;
  }
  
  /**
   *
   * @param string $name
   * @return UserModel
   */
  public static function getByName($name) {
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
}
