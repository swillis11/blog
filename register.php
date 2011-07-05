<?php include_once("content/header.php"); 

	$errmsg_arr = array();
	$errflag = false;
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$username = $_POST['User'];
	$password = $_POST['Pass'];
	$cpassword = $_POST['cPass'];
	
	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}
	if($username == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
        
        if($username != '') {
	$qry = "SELECT * FROM Users WHERE username='$username'";
	$result = mysql_query($qry);
            if($result) {
		if(mysql_num_rows($result) > 0) {
			$errmsg_arr[] = 'Username already in use';
			$errflag = true;
		}
		@mysql_free_result($result);
            }
            
            else {
            	die("Query failed dupes");
            }
	}


?>

    <div id="main">

   <form  id="loginForm"  name="loginForm" method="post"   action="registerx.php">
        <input class="login" name="fname" maxlength="25"     type="text" placeholder="First name" autofocus />
        <input class="login" name="lname" maxlength="25"    type="text"  placeholder="Last name"     />
        <input class="login" name="User"  maxlength="25"    type="text"  placeholder="Desired Username"     />
        <input class="login" name="Pass"  maxlength="25"    type="password" placeholder="Password"   />
        <input class="login" name="cPass" maxlength="25"    type="password" placeholder="Confirm"  />&nbsp;
        <br></br>
        <input type="submit"    name="Submit"   value="Register" />
    </form>
    </div>
</body>
</html>
