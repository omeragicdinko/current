<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');



require_once('../vendor/autoload.php');
require_once('config.php');
require_once('dao/UserDao.class.php');
require_once('dao/CarDao.class.php');
require_once('dao/CommentDao.class.php');
require_once('dao/RentBaseDao.class.php');

Flight::register('user_dao', 'UserDao');
Flight::register('car_dao', 'CarDao');
Flight::register('comment_dao', 'CommentDao');
Flight::register('base_dao', 'RentBaseDao');


Flight::route('GET /users', function(){
 $users = Flight::user_dao()->get_all();
 Flight::json($users);
});

Flight::route('GET /bases', function(){
 $bases = Flight::base_dao()->get_all();
 Flight::json($bases);
});

Flight::route('POST /base', function(){
    $base = Flight::request()->data->getData();
    Flight::base_dao()->add($base);
});

Flight::route('GET /user/@id', function($id){
 $users = Flight::user_dao()->get_user_by_id($id);
 Flight::json($users);
});

Flight::route('GET /car/@id', function($id){
 $cars = Flight::car_dao()->get_car_by_id($id);
 Flight::json($cars);
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

Flight::route('GET /workers', function(){
 $workers = Flight::user_dao()->get_workers();
 Flight::json($workers);
});

Flight::route('DELETE /user/@id', function($id){
  Flight::user_dao()->delete_user($id);
});

Flight::route('DELETE /base/@id', function($id){
  Flight::base_dao()->delete_base($id);
});

Flight::route('GET /non-workers', function(){
 $nonWorkers = Flight::user_dao()->get_non_workers();
 Flight::json($nonWorkers);
});

Flight::route('POST /non-worker/'+id, function($id){
  Flight::user_dao()->delete_non_worker($id);
});


//select dodati u id_base da bi admin mogao birati zbog fk https://materializecss.com/select.html
//autentikacija
//final touch
//select za avvailability




Flight::start();
?>
