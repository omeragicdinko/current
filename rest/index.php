<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');



require_once('../vendor/autoload.php');
require_once('config.php');
require_once('dao/UserDao.class.php');

Flight::register('user_dao', 'UserDao');



Flight::route('GET /users', function(){
 $users = Flight::user_dao()->get_all();
 Flight::json($users);
});

Flight::route('POST /user', function(){
    $user = Flight::request()->data->getData();
    Flight::user_dao()->add($user);
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

//napravili listu auta i prebaciti ih u listu sa searchom
//napraviti stranice za auta automatske sa dodatnim informacijama i dodatnim opcijama
//dodati submission za comentare i stranicu sa komentarima
//napraviti admin/worker ui i user ui razlicit
//dodati mogucnost dodavanja novog radnika samo sa worker/admin page-a

/*Flight::route('DELETE /user/@id', function($id){
     $delete = "DELETE FROM users WHERE id = :id";

     $stmt= Flight::db()->prepare($delete);
     $stmt->execute([":id" => $id]);
});*/


Flight::start();
?>
