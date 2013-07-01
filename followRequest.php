<?php

 session_start();
 if(!isset($_SESSION['userName'])){
  header("location:login.php");
 }
 
 $userName = $_SESSION['userName'];
 
 $followTo = $_GET["follow"];
 echo $followTo;

 $loginDB=13;
 $followingDB =10;
 $followersDB =15;
 
 require "predis/autoload.php";
 Predis\Autoloader::register(); 

 try {
    
  $redis = new Predis\Client();
  $redis->connect('127.0.0.1', 6379);
  $redis->select($followingDB);
  $redis->sAdd($userName, $followTo);
  $_SESSION['followingCount'] = $followingCount+1;

  $redis->select($followersDB);
  $redis->sAdd($followTo, $userName);
  
 // $userFollowing=$redis->sMembers($folowTo);
  
  header("location:profile.php");
 }
 catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
 }

 
?>