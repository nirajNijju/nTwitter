<?php

 session_start();
 if(!isset($_SESSION['userName'])){
  header("location:login.php");
 }
 
 $userName = $_SESSION['userName'];
 $newTweet=$_POST['newTweet'];
 
 $time=time();
 $tweetString = $userName."|".$time."|".$newTweet; 
// echo $tweetString;
 
 include 'selectDB.php';
 require "predis/autoload.php";
 Predis\Autoloader::register();
 

try {
 $redis = new Predis\Client();
 $redis->connect('127.0.0.1', 6379);

 $redis->select($post);
 //echo "1";
 $postId = $redis->incr("postId");
 $redis->set($postId,$tweetString);
 
 echo "1";
 $redis->select($userPost);
 $redis->lPush($userName, $postId);
 
 $redis->select($followersDB);
 $userFollower=$redis->sMembers($userName);
 $redis->select($display);
 
 //echo "displaDb:".$display." ";
 foreach ($userFollower as $user)  {
    $redis->lPush($user, $postId);
    echo $user;
  }
  $redis->lPush($userName, $postId);
 
 //echo $userName.$postId;
 
 header("location:profile.php");
 
}
catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
}
 
 
 
 //echo $userName;
?>