<?php include_once("content/header.php"); ?>

<div id="main">
  
<?php
    if (isset($_GET['error']) && !empty($_GET['error'])){
        
        if($_GET['error']==1)
             echo ' <td>Invalid login data supplied.</td>';
    }
    
    if($_GET['logout'] == 1){
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['userlevel']);
        unset($_SESSION['loggedin']);
        unset($_SESSION['postid']);
        //add another session function to close session

//        echo "You have logged out.";
        sleep(1);
        header("Location: index.php");
    }
        
?>    
   
<?php
if ($_SESSION["loggedin"] != "true"){
?>
    
<form name="login" method="post" action="verify.php">
     <input class="login" type="text" name="username" maxlength="25"  placeholder="username" autofocus />
     <input class="login" type="password" name="password" maxlength="25" placeholder="password" />
     <input type="submit" name="Submit" value="Submit">
</form>

<?php

    $query = "SELECT username,password,uid FROM Users WHERE username = '$username' AND password = '$password'";
    $user = mysql_fetch_array($query);
    $id = $user['id']; 

} //End session not logged in check.

else{
?>

    <p>You are logged in.</p>
    <ul>

<?php
    echo "<li><a href='usercp.php?id=$id'>&nbsp;View my account</a></li>" //This is really bad because you can just change the id in the address bar LOL. Track the ID with the session.

?>
    <li><a href="login.php?logout=1">&nbsp;Log out</a></li> <!--I just changed this to set logout=1 to the login.php file instead of sending the user to a separate logout.php file like I had before.-->

    </ul>
<?php } ?>

    </div><!--End main-->

<div id="footer">
</div>
    
</body>
</html>
