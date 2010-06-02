<?php
/**
 * Extends DAO to provide Category Specific functionality
 * @author Argel Arias <levhita@gmail.com>
 * @package TianguisCabal
 */
class CategoryModel extends DAO {
  
  public function __construct($id){
    parent::__construct('Categoria', (int)$id);
    parent::setIdField('CatID');
  }
  /**
   * Gets All Categories
   * @return array
   */
  public static function getAll()
  {
    $sql = 'SELECT * FROM Categoria';
    $DbConnection = DbConnection::getInstance();
    return $DbConnection->getAll($sql);
  }
}
