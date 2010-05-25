<?php
/**
 * @package TianguisCabal
 * @author Argel Arias <levhita@gmail.com>
 */

/**
 * Extends DAO to provide Category Specific functionality 
 */
class CategoryModel extends DAO {
  public function __construct($id){
    parent::__construct('categoria', (int)$id);
    parent::setIdField('CatID');
  }
  
  public static function getAll()
  {
    $sql = 'SELECT * FROM categoria';
    $DbConnection = DbConnection::getInstance();
    return $DbConnection->getAll($sql);
  }
}