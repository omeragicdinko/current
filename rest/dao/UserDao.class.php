<?php
require_once 'BaseDao.class.php';

class UserDao extends BaseDao{

  public function __construct(){
    parent::__construct('users');
  }

  public function get_user_by_email($email){
    $query = "SELECT * FROM users WHERE email=:email";
    return @($this->execute_query($query, ['email' => $email]))[0];
  }

  public function get_user_by_id($id){
    $query = "SELECT * FROM users WHERE id=:id";
    return @($this->execute_query($query, ['id' => $id]))[0];
  }

  public function get_workers(){
    $query = "SELECT * FROM users WHERE job IS NOT null";
    return $this->execute_query($query, []);
  }

  public function delete_user($id){
    $query = "DELETE FROM users WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

  public function get_non_workers(){
    $query = "SELECT * FROM users WHERE job IS null";
    return $this->execute_query($query, []);
  }

  public function delete_non_worker($id){
    $query = "DELETE * FROM users WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

}
?>
