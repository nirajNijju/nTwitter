<?php

 session_start();
 if(!isset($_SESSION['userName'])){
  header("location:login.php");
 }
 
 $userName = $_SESSION['userName'];
 
 include 'selectDB.php';
 require "predis/autoload.php";
 Predis\Autoloader::register();
 
?>

<html>
<head><title><?php echo $userName." | nTwitter" ?></title></head>

<body>

<?php include 'header.php'; ?> 

<table align="center" border="1" width="60%">
 <tr>
  <td><i>Compose new Tweets ...</i><br />
      <form name="newTweet" method="post" action="newTweet.php">
		  <input name="newTweet" type="text" size="70"><br />
		  <p align="right"><input type="submit" name="Submit" value="tweet it ..." ></p>
		</form>
  </td>
 </tr> 
 <?php
 
 try {
  $redis = new Predis\Client();
  $redis->connect('127.0.0.1', 6379);

  $redis->select($display);
  $postArray=$redis->lRange($userName, 0, 10);
 
  $timeNow = time();
  $redis->select($post);
  foreach ($postArray as $postId)  {
 	
    $tweetString = $redis->get($postId);
    //echo $tweetString."  ";
   
    $tweetArray = explode("|",$tweetString);
    //echo $tweetArray[1];
    
    $user = $tweetArray[0];
    $time = $tweetArray[1];    
    $timeDiff = $timeNow-$time;
    $timeMin = floor($timeDiff/60);
    $timeHr = floor($timeDiff/3600);
    
    $timemlag="";
    if($timeHr>1){
    	$timelag = $timeHr." hour ago";
    }else {
    	$timelag = $timeMin." min ago";
    }
    $tweet =$tweetArray[2];
    $i=3;
    $size = sizeof($tweetArray);
    for($i=3; $i<$size; $i++ ) {
    	$tweet = $tweet."|".$tweetArray[$i];
    }
    
    echo "<tr><td>";
    echo "<font color=\"blue\" >".$user."</font><font size=1><i>".$timelag."</i></font><br />";
    echo "<p align=\"left\">".$tweet."</p>";
    echo "</tr></td>";
    
  }

}
catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
}
 
 ?> 
 
</table>
</body>
</html>