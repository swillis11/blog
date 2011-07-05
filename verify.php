<?php session_start();
        include_once("content/connect.php"); 

	$username = $_POST['username'];
	$password = $_POST['password'];//md5($_POST['password']);
        
        $query="SELECT username,password,uid,level FROM Users WHERE username='$username' AND password='$password'";
        
	$result = mysql_query($query);
        
        if(mysql_num_rows($result) == 1){
            $row  = mysql_fetch_array($result) or die(mysql_error());
            
            $_SESSION['userid']   =$row['uid'];
            $_SESSION['userlevel']=$row['level'];
            $_SESSION['username'] =$row['username'];

        }
        
        else {
 		$_SESSION['loggedin'] = "false";
                header("Location: login.php?error=1"); 

        }

	if(mysql_num_rows($result) == 1){	
		$_SESSION['loggedin'] = "true";
                header("Location: index.php");
	}
	
        else
            header('Location: http://64.142.73.35/Blog-v2.0/login.php?error=1');

?>