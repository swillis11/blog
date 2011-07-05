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
	
	//Check for duplicate users
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
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: register.php");
		exit();
	}

	$qry = "INSERT INTO Users(firstname, lastname, username, password) VALUES('$fname','$lname','$username','$password')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: index.php");
                sleep(1);
		exit();
	}else {
		die("Query failed success $fname,$lname,$username,$password");
	}

        
include("content/footer.php"); ?>
