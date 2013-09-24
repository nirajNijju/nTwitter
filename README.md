nTwitter
========

a Twitter clone by niraj


<html>
<head></head>
<body>
<br /><br />

<center>
<h2>nTwitter </h2> a Twitter clone by niraj
<!--
<br /><br />
Link to source code at <a href="https://github.com/nirajNijju/nTwitter" target="_blank">github</a>
 <br /> <br /> Go to <a href="http://ec2-54-224-194-128.compute-1.amazonaws.com/nTwitter/login.php" target="_blank" >loginPage</a>
 -->
</center>
<br /><br />
<table align="center" width="80%" border="1">
 <tr>
   <td width="20%">Login & Create Account</td>
   <td>
     <div> Functionality added
        <ul>
          <li>For Create account if any field is missing then proper message will display.</li>
          <li>If a user wants to create an account and his entered userName is already used then he will be shown proper message.</li>
          <li>No user cannot access to any other page(except login.php) without login into it.</li>
        </ul>
     </div>
     <div>Further TODO
       <ul> 
         <li>Authenticate an account with email.</li>
         <li>To add forgot password request.</li>
       </ul>
     </div>
      
   </td>
 </tr>

 <tr>
   <td width="20%">Search a user</td>
   <td>
     <div> Functionality added
        <ul>
          <li>One can search a user by userName.</li>
          <li>All the users Whom you are following will be top result.</li>
          <li>Users which contain the search query word will be followed by users who's name starting by same queries</li>
          <li>To list all the users give query as *(asterix)</li>
        </ul>
     </div>
     <div>Further TODO
       <ul> 
         <li>Search to be made auto suggested .</li>
       </ul>
     </div>
      
   </td>
 </tr>

 <tr>
   <td width="20%">Follow a user</td>
   <td>
     <div> Functionality added
        <ul>
          <li>One can follow any number of users. </li>
          <li>In home page it will show the count of users you are following and the no of users following you.</li>
        </ul>
     </div>
     <div>Further TODO
       <ul> 
         <li><strike>On clicking on the follower/following count the list of users should be shown.</strike> (Done on july 3)</li>
         <li>To add UnFollow option.</li>
         <li>To add block option. Once a user is blocked by a person then he cann't follow the person anymore.</li>
       </ul>
     </div>
      
   </td>
 </tr>

 <tr>
   <td width="20%">Compose Tweets</td>
   <td>
     <div> Functionality added
        <ul>
          <li>Tweet is saved with corresponding user and timeStamp .</li>
          <li>When a user Tweeted a tweet it will appear in his timeline and timeline of all the users who are following at now.</li>
        </ul>
     </div>
     <div>Further TODO
       <ul> 
         <li>When a link will be in tweet it should automatically handle it and make this link as href(source) and link to tittle off that page.</li>
         <li>To take care of  &#60;script&#62; and others.</li>
         <li>To tag a user in a tweet</li>
       </ul>
     </div>
      
   </td>
 </tr>

 <tr>
   <td width="20%">TimeLine</td>
   <td>
     <div> Functionality added
        <ul>
          <li>In TimeLine the 10 latest tweet of the user or the users s/he following will be shown.</li>
          <li>A User will get only those tweets from other user(which s/he is following) which are tweeted after s/he start following them.</li>
        </ul>
     </div>
     <div>Further TODO
       <ul> 
         <li>To add Delete a Tweet( only those tweets will have delete option which are tweeted by user ).</li>
         <li>To add ReTweet/Share/Like a Tweet.</li>
       </ul>
     </div>
      
   </td>
 </tr>

 <tr>
   <td width="20%">Few more TODO's</td>
   <td>
     <div> 
        <ul>
         <li>Profile page of User, which will contains latest tweet of his own.</li>
         <li>A user can see profile page of other user</li>
       </ul>
     </div>
      
   </td>
 </tr>

</table>

</body>
</html>
