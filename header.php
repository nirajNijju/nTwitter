 <table align="center" border="1" width="60%">
 <caption ><p align="left"><h3><?php echo "Welcome <a href=\"profile.php\">".$userName."</a>	" ?></h3></p>
			 <p align="right">
			   <i><font size="2">
			       <?php echo "<a href =\"followersList.php\">followers</a>(".$_SESSION['followerCount'].") 
			       <a href =\"followingList.php\">following</a>(".$_SESSION['followingCount'].")"; ?>
			    </font></i>
			   <a href="logout.php" >logout</a><br />
			   
			 </p>
 </caption>
 <tr>
 <td align="right">
   <form name="login" method="post" action="search.php" >
	  <input name="userSearch" type="text" size="10">
	  <input type="submit" name="Submit" value="search" >
	</form>
 </td>
 </tr>
 </table>