<?php
 //List of the users who are following you
 
 session_start();
 if(!isset($_SESSION['userName'])){
  header("location:login.php");
 }
 
 $userName = $_SESSION['userName'];
 
 include 'selectDB.php';
 require "predis/autoload.php";
 Predis\Autoloader::register(); 


 try {
    
  $redis = new Predis\Client();
  $redis->connect('127.0.0.1', 6379);

  $redis->select($followersDB);
  $userFollower=$redis->sMembers($userName);
  $redis->select($followingDB);
  $userFollowing=$redis->sMembers($userName);
  
  $FollowersYouFollow = array_intersect($userFollower,$userFollowing);
  $FollowersYouNotFollow =array_diff($userFollower,$FollowersYouFollow);
  
 }
 catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
 }

?>

<html>
<head><title><?php echo $userName." | Followers | nTwitter" ?></title></head>
<body>

<?php include 'header.php'; ?> 
 <table align="center" border="1" width="60%">
 <caption>These users are Following you </caption>
 <?php
 
  $count =0;
  foreach ($FollowersYouFollow as $value)  {
    if(strlen($value) >0) {
    	echo "<tr><td>".$value."<font size=\"1\"><i> Unfollow</i></font></td></tr>   ";
    	$count++;
    }
  }
  
  foreach ($FollowersYouNotFollow as $value)  {
    if(strlen($value) >0) {
    	echo "<tr><td>".$value."<font size=\"1\"><i><a href =\"followRequest.php/?follow=".$value."\"> follow</a></i></font></td></tr>   ";
    	$count++;
    }
  }
  $_SESSION['followerCount'] = $count;
 ?>
 </table>


</body>
</html>