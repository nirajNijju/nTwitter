<?php
 //List of the users you are following..
 
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

  $redis->select($followingDB);
  $userFollowing=$redis->sMembers($userName);
  
 }
 catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
 }

?>

<html>
<head><title><?php echo $userName." | Following | nTwitter" ?></title></head>
<body>

<?php include 'header.php'; ?> 
 <table align="center" border="1" width="60%">
 <caption>You are Following these users </caption>
 <?php
 
  $count =0;
  foreach ($userFollowing as $value)  {
    if(strlen($value) >0) {
    	echo "<tr><td>".$value."<font size=\"1\"><i> Unfollow</i></font></td></tr>   ";
    	$count++;
    }
  }
  $_SESSION['followingCount'] = $count;
 ?>
 </table>
 </body>
</html>