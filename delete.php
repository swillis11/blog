
<html>
<head>
<title>The Blog</title>
</head>
<body>


<?php

$id   = $_POST['Id'];

mysql_connect("localhost","root","pma") or die(mysql_error());
mysql_select_db("Blog") or die(mysql_error());
 
mysql_query("DELETE FROM Post WHERE Id='$id'") or die(mysql_error());
 
die("Your post has been successfully deleted.");
 
?>
