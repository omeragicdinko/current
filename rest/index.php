<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');



require_once('../vendor/autoload.php');
require_once('config.php');
require_once('dao/UserDao.class.php');
require_once('dao/CarDao.class.php');
require_once('dao/CommentDao.class.php');

Flight::register('user_dao', 'UserDao');
Flight::register('car_dao', 'CarDao');
Flight::register('comment_dao', 'CommentDao');


Flight::route('GET /users', function(){
 $users = Flight::user_dao()->get_all();
 Flight::json($users);
});

Flight::route('POST /user', function(){
    $user = Flight::request()->data->getData();
    Flight::user_dao()->add($user);
});

Flight::route('POST /car', function(){
    $car = Flight::request()->data->getData();
    Flight::car_dao()->add($car);
});

Flight::route('POST /login', function(){
  $user = Flight::request()->data->getData();
  $db_user = Flight::user_dao()->get_user_by_email($user['email']);

  if ($db_user){
    if ($db_user['password'] == $user['password']){
      Flight::json($db_user);
    }else{
      Flight::halt(404, 'Password Incorrect');
    }
  }else{
    Flight::halt(404, 'User not found');
  }

});


Flight::route('GET /cars', function(){
 $cars = Flight::car_dao()->get_car_info();
 Flight::json($cars);
});



Flight::route('POST /car/@id', function($id){
    Flight::car_dao()->update_availability($id);
});

Flight::route('GET /comments', function(){
 $comments = Flight::comment_dao()->get_all();
 Flight::json($comments);
});

Flight::route('POST /comment', function(){
    $comment = Flight::request()->data->getData();
    Flight::comment_dao()->add($comment);
});

//dodati da se auta mogu modificirati i brisati kao i workeri..
//select dodati u id_base da bi admin mogao birati zbog fk https://materializecss.com/select.html
//autentikacija
//ifnal touch

/*Flight::route('DELETE /user/@id', function($id){
     $delete = "DELETE FROM users WHERE id = :id";

     $stmt= Flight::db()->prepare($delete);
     $stmt->execute([":id" => $id]);
});*/


Flight::start();
?>
