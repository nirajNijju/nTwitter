<?php

session_start();

 include 'selectDB.php';
 /*
 $loginDB=13;
 $followingDB =10;
 $followersDB =15;
 */

 $userName=$_POST['userName'];
 $password=$_POST['password'];

 echo $userName;
 echo $password;
 if(!$userName  || !$password){
 	header("location:index.php/?retry=1");
 }


require "predis/autoload.php";
Predis\Autoloader::register();

try {
    $redis = new Predis\Client();
    

 $redis->connect('127.0.0.1', 6379);

 $redis->select($loginDB);
 $val =  $redis->get($userName);

 $redis->select($followersDB);
 $followerCount = $redis->sCard($userName);
 $redis->select($followingDB);
 $followingCount = $redis->sCard($userName);  
 
 if($val == $password) {
 	$_SESSION['userName'] = $userName;
 	$_SESSION['followingCount'] = $followingCount;
	$_SESSION['followerCount'] = $followerCount;
	
 	header("location:profile.php");
	echo "equal";
 }else {
	echo "not ".$val." ";
	header("location:login.php/?retry=1");
 }
 
}
catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
}


?>
