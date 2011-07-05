<?php include("content/header.php"); ?>

<div id="main" >

<?php

$pid=$_GET['pid'];
$result = mysql_query("SELECT Users.uid FROM Post,Users WHERE Post.uid=Users.uid AND Post.pid='$pid'") or die(mysql_error());
$row = mysql_fetch_array($result);




if($_SESSION['loggedin']==true && $_SESSION['userid']=$row['uid']){
    
    $tag=$_POST['tag'];
    
    $exists = mysql_query("SELECT * FROM Tags WHERE Tags.name='".$_POST['tag']."'") or die(mysql_error());
    $tid = mysql_fetch_array($exists);
    
    if (isset($_POST['Post'])){
              
        if (!empty($tag)){
            if(mysql_num_rows($exists)==0){
                mysql_query("INSERT INTO Tags (Name) VALUES ('".$_POST['tag']."')") or die(mysql_error());
                mysql_query("INSERT INTO PostTag (PID,TID) VALUES ('$pid',LAST_INSERT_ID())") or die(mysql_error());
            }
            else
                mysql_query("INSERT INTO PostTag (PID,TID) VALUES ('$pid','".$tid['TID']."')") or die(mysql_error());
            
        unset($_POST);

        header("Location: index.php");
        sleep(1);
        }
        
        else
            echo "You must fill in a tag first.";
 
    
    }
    
    else
        echo "Add a tag below.";  
    
    ?>
    <!--Git works-->
    <form action='addtag.php?pid=<?echo $pid;?>' method='POST'>

	<ul>	
		<li>
			<input class="login" name="tag" maxlength="25" type="text" placeholder="New Tag" autofocus />
		</li>
		
		<input type='submit' name='Post' value='Submit' />
		
	</ul>
    </form>
    
    <?
}

else
    echo "You must log in add a tag.";

?>


    <?php include("content/footer.php"); ?>