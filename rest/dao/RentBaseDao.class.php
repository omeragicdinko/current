<?php
require_once 'BaseDao.class.php';

class RentBaseDao extends BaseDao{

  public function __construct(){
    parent::__construct('bases');
  }

  public function delete_base($id){
    $query = "DELETE FROM bases WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

}
?>
