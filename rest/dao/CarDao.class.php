<?php
require_once 'BaseDao.class.php';

class CarDao extends BaseDao{

  public function __construct(){
    parent::__construct('cars');
  }

  public function get_car_info(){
    $query = "SELECT cars.*, bases.name base_name,bases.location, bases.phone_number FROM cars JOIN bases WHERE cars.id_base=bases.id";
    return $this->execute_query($query,[]);
  }

  public function update_availability($id){
    $query = "UPDATE cars SET availability='NO' WHERE id = :id";
    return @($this->execute_query1($query,["id" => $id]))[0];
  }
}
?>
