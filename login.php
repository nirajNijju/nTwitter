<?php
session_start();

 if(isset($_SESSION['userName'])){
  header("location:profile.php");
 }


 $retry=$_GET['retry'];
 
 if($retry > 0){
 	header('Refresh: 5; URL=http://localhost/nTwitter/login.php');
 }
/*
 if($retry > 0){
        header('Refresh: 5; URL=http://ec2-54-224-194-128.compute-1.amazonaws.com/nTwitter/login.php');
 } 
*/ 
 if($retry==1){
  echo "<center><font color=red >Wrong Username or Password</font></center><br />";
 }

?>

<!DOCTYPE html>
<html>
<head>
	<!--<link rel="stylesheet/less" href="style.less">
	<script src="less.js"></script>-->
</head>
<body>

		<div class="wrapper" align="center">
			<span>Login Details</span>
			<form name="login" method="post" action="checkLogin.php">
				UserName : <input name="userName" type="text"><br />
				Password :<input name="password" type="password"><br />
				<input type="submit" name="Submit" value="Login">
			</form>
		</div>

			
<br /> <br />

<?php			
 if($retry==2){
  echo "<center><font color=red ><b>Username already exist</b></font></center><br />";
 }
 if($retry==3){
  echo "<center><font color=red ><b>password doesn't match</b></font></center><br />";
 }
 if($retry==4){
  echo "<center><font color=red ><b>Missing Details</font></b></center><br />";
 }
 if($retry==5){
  echo "<center><font color=blue ><b>Account successfully created</b></font></center><br />";
 }
?>

			<div class="panel right" align="center">
				<h3>New to nTwitter?</h3>
				<p>
					<form name="creatAccount" method="post" action="creatAccount.php">
						UserName :<input name="userName" type="text"><br />
						Password :<input name="password" type="password"><br />
						Password :<input name="password2" type="password"><br />
						<input type="submit" name="Submit" value="createAccount">
					</form>
				</p>
			</div>
<!--
		</div>
	</div>
-->
</body>
</html>
