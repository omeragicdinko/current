<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

require '../vendor/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=remotemysql.com;dbname=22D7SSPtYw','22D7SSPtYw','0FZwBnSQli'));

Flight::route('GET /users', function(){
 $users = Flight::db()->query('SELECT * FROM users', PDO::FETCH_ASSOC)->fetchAll();
 Flight::json($users);
});

Flight::route('POST /users', function(){
    $request = Flight::request()->data->getData();
    unset($request['psword_confirm']);
    print_r($request);
    $insert = "INSERT INTO users (user_name, user_surname, user_phone_number, user_email, user_street_address, user_city, user_country, user_password ) VALUES(:fname, :lname, :user_phone_number, :user_email, :user_address, :user_city, :user_country, :psword)";
    $stmt= Flight::db()->prepare($insert);
    $stmt->execute($request);
});

Flight::route('DELETE /user/@id', function($id){
     $delete = "DELETE FROM users WHERE id_user = :id";

     $stmt= Flight::db()->prepare($delete);
     $stmt->execute([":id" => $id]);
});


Flight::start();
?>
