<?php
require_once 'BaseDao.class.php';

class CommentDao extends BaseDao{

  public function __construct(){
    parent::__construct('comments');
  }

}
?>
