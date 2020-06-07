<?php
require_once 'BaseDao.class.php';

class CommentDao extends BaseDao{

  public $table = 'comments';
  
  public function __construct(){
    parent::__construct($this->table);
  }

}
?>
