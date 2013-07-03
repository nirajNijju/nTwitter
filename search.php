<?php

 session_start();
 if(!isset($_SESSION['userName'])){
  header("location:login.php");
 }
 
 $userName = $_SESSION['userName'];
 $userSearch=$_POST['userSearch'];

 include 'selectDB.php';
 require "predis/autoload.php";
 Predis\Autoloader::register(); 

 try {
    
  $redis = new Predis\Client();
  $redis->connect('127.0.0.1', 6379);
  $redis->select($loginDB);
 
  $usersArray1 = $redis->keys($userSearch.'*');
  $array2 = $redis->keys('*'.$userSearch.'*');
  $usersArray2 =array_diff($array2,$usersArray1);
  $redis->select($followingDB);
  $userFollowing=$redis->sMembers($userName);
  
  $folloing1=array_intersect($usersArray1,$userFollowing);
  $folloing2=array_intersect($usersArray2,$userFollowing);
  $nonFollowing1=array_diff($usersArray1,$folloing1);
  $nonFollowing2=array_diff($usersArray2,$folloing2);
  
  $count =0;
 
 }
 catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
 }

?>

<html>
<head><title><?php echo $userName." |Search | nTwitter" ?></title></head>
<body>

<?php include 'header.php'; ?> 
 <table align="center" border="1" width="60%">
 <caption>Search Result for "<?php echo $userSearch ?>"</caption>
 <?php
   foreach ($folloing1 as $value)  {
    echo "<tr><td>".$value."<font size=\"1\"><i> following</i></font></td></tr>   ";
    $count++;
  }
  foreach ($folloing2 as $value)  {
    echo "<tr><td>".$value."<font size=\"1\"><i> following</i></font></td></tr>   ";
    $count++;
  }
  foreach ($nonFollowing1 as $value)  {
    echo "<tr><td>".$value."<font size=\"1\"><i><a href =\"followRequest.php/?follow=".$value."\"> follow</a></i></font></td></tr>   ";
    $count++;
  }
  foreach ($nonFollowing2 as $value)  {
    echo "<tr><td>".$value."<font size=\"1\"><i><a href =\"followRequest.php/?follow=".$value."\"> follow</a></i></font></td></tr>   ";
    $count++;
  }
 
 ?>
 </table>
</body>
</html>