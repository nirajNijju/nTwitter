<?php

 session_start();
 if(!isset($_SESSION['userName'])){
  header("location:login.php");
 }
 
 $userName = $_SESSION['userName'];
 
 include 'selectDB.php';
 require "predis/autoload.php";
 Predis\Autoloader::register();
 
 $redisDelete = new Predis\Client();
 $redisDelete->connect('127.0.0.1', 6379);
 $redisDelete->select($post);
?>

<?       
  if ($_POST['deleteT']){ 
     echo "deleting ...".$_POST['postId']." --- ";
     
    $tweetToDelete = $redisDelete->get($_POST['postId']); 
    $tweetDeleteArray = explode("|",$tweetToDelete);
    //echo $tweetArray[1];
    
    $msg = $tweetDeleteArray[0];
    $time = $tweetDeleteArray[1]*(-1);
    $msg = $msg."|".$time."|".$tweetDeleteArray[2];
    $size = sizeof($tweetDeleteArray);
    for($i=3; $i<$size; $i++ ) {
    	$msg = $msg."|".$tweetDeleteArray[$i];
    }
    echo " msg:".$msg;
	 $redisDelete->set($_POST['postId'],$msg);
	
	    //echo "       ".$time." ".$tweetDeleteArray[1] ;
	    //echo $tweetDeleteArray[0]." ".$tweetDeleteArray[1];;
	    
  } 
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

  $count=0;
  $range=0;
  $range2=$range+10;
  
  while($count < 10) {
  	  $redis->select($display);
	  $postArray=$redis->lRange($userName, $range, $range+10);
	  $range=$range+10;
	  if(sizeof($postArray)==0 ){
	  	 //echo "breaking loop";
	  	 break;
	  }
	  $timeNow = time();
	  
	  $redis->select($post);
	  foreach ($postArray as $postId)  {
	  	 if($count == 10 ){
	  	   //echo "breaking loop";
	  	   break;
	    }
	 	
	    $tweetString = $redis->get($postId);
	    //echo $tweetString."  ";
	   
	    $tweetArray = explode("|",$tweetString);
	    //echo $tweetArray[1];
	    
	    $user = $tweetArray[0];
	    $time = $tweetArray[1];  
	    if($time >0){  
	       $count++;
		    $timeDiff = $timeNow-$time;
		    $timeMin = floor($timeDiff/60);
		    $timeHr = floor($timeDiff/3600);
		    $timeDay= floor($timeHr/24);
		    
		    $timemlag="";
		    if($timeHr >24) {
		    	$timelag = $timeDay." day ago";
		    }else if($timeHr>0){
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
		    if($user == $userName) {
		    	//echo "<p align=\"right\"><button onclick=\"deleteTweet(".$postId.")\">Click me</button></p>";
		    	echo "<div float=\"right\"><form method=\"post\" action=\"\">
		    	         <input type=\"hidden\" name=\"postId\" value=\"".$postId."\">
		    	         <input type=\"Submit\" name=\"deleteT\" value=\"delete\"> 
					  </form></div>";
		    }
		    echo "</td></tr>";
	    
	    }// end of if
	  }// end of for
	//echo $count;
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