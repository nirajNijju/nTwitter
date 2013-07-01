<?php

 require "predis/autoload.php";
 Predis\Autoloader::register();


session_start();

 include 'selectDB.php';

 $userName=$_POST['userName'];
 $password=$_POST['password'];
 $password2=$_POST['password2'];

 
 if(!$userName  || !$password || !$password2){
 	header("location:login.php/?retry=4");
 }else if($password != $password2){
 	header("location:login.php/?retry=3");
 }else {


 try {
    
  $redis = new Predis\Client();
  $redis->connect('127.0.0.1', 6379);
  $redis->select($loginDB);
 
  //$EXISTS = $redis->get($userName);
  if($redis->get($userName)){
 	header("location:login.php/?retry=2");
  }else {
 
  $redis->set($userName, $password);
  
  $redis->select($followingDB);
  $redis->sAdd($userName, $userName);
  header("location:login.php/?retry=5");
  }
 }
 catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
 }
}

?>