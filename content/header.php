<?php

	session_start();
		
	require_once("connect.php");

	if(!empty($_GET['pageid'])){
		$pageid=$_GET['pageid'];
	}
	else
		$pageid=0;
		
	$postid=$_GET['postid'];
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><? echo("$page_title"); ?></title>
	
	<base href="http://64.142.73.35/Blog-NB/" />
	
	<!--<link rel="stylesheet" href="css/reset.css" type="text/css" /> -->
        <link rel="stylesheet" href="css/default.css" type="text/css" media="screen" title="default" />
<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" /> -->
</head>

<body>
    <div id="wrapper">
	<div id="header" >
            <h1>Blog Title</h1>
	</div>
	
	<div id="login" >
            
<?php      
            if($_SESSION['loggedin']){ 
?>
            <div id='newpost'>
                    <a href='editpost.php?addpost=1'><img src='images/login/newpost.png' /></a>
            </div>

            <div id='loginsettings'>
                    <ul>
                            <li>
                                    <ul>
                                            <li><a href='#'>My Account</a></li>
                                            <li><a href='#'>Manage Posts</a></li>
                                            <li><a href='login.php?logout=1'>Log Out</a></li>
                                    </ul>   
                            </li>
                    </ul>
            </div>   
<?php }
            else{ 
?>
            <div id='newpost'>
                    <a href='login.php'><img src='images/login/login.png' /></a>
            </div>
            
            <div id='newpost'>
                    <a href='register.php'><img src='images/login/register.png' /></a>
            </div>
<?          } 
?> 
        </div>
	<div id="archive" >
	</div>
	
	
