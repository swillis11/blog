<?php include("content/header.php"); ?>

<div id="main" >

<?php

$pid=$_GET['pid'];
$view=$_GET['view'];

if($view==1){
    $postresult   = mysql_query("SELECT * FROM Post,Users WHERE Post.pid='$pid' AND Post.uid=Users.uid");
    $result = mysql_query("SELECT Users.firstname,Users.lastname,Comments.Text,Comments.DateCreated 
                            FROM Users,Comments WHERE Comments.uid=Users.uid AND Comments.pid='$pid'") or die(mysql_error());

    $displaypost = mysql_fetch_array($postresult);
    $tagquery = "SELECT Tags.name,Tags.tid FROM Tags,Post,PostTag WHERE Post.pid=PostTag.pid 
                AND PostTag.pid='$pid' AND PostTag.tid=Tags.tid;";
    $tagresult=mysql_query($tagquery);

 
     echo "<div class='post'>\n";
     echo 	"<h2> ".$displaypost['Title']." </h2>\n";
     echo 	"<p> ".$displaypost['firstname']." ".$displaypost['lastname']. " at ".$displaypost['DateCreated']." </p>\n";  //change to date modified.
     echo 	"<p> ".$displaypost['Description']." </p>\n";

     if(mysql_num_rows($tagresult)>0){
        echo "tags:";

        while($tags = mysql_fetch_array($tagresult))
          echo "<a href='view.php?tid=".$tags['tid']."'> ".$tags['name']."</a>";   

        }
    
    while($row = mysql_fetch_array($result)){
         echo "<div class='comments'>\n";
         echo 	$row['Text']."\n";
         echo 	"<p> ".$row['firstname']." ".$row['lastname']. " at ".$row['DateCreated']." </p></div>\n";  //change to date modified.
    }
}


else if($_SESSION['loggedin']==true){
    
    $comment=$_POST['Comment'];
    
    if (isset($_POST['Post'])){
              
        if (!empty($comment)){
   
        mysql_query("INSERT INTO Comments (pid,uid,Text)
                        VALUES('$pid','".$_SESSION['userid']."','".$_POST['Comment']."')")
                                                                         or die(mysql_error());
        
        unset($_POST);

        header("Location: index.php");
        sleep(1);
        }
        
        else
            echo "You must fill in a comment first.";
 
    
    }
    
    else
        echo "Add your comment below.";  
    
    ?>
    
    <form action='comment.php?pid=<?echo $pid;?>' method='POST'>

	<ul>	
		<li>
			<textarea id='body' name='Comment'></textarea>
		</li>
		
		<input type='submit' name='Post' value='Submit' />
		
	</ul>
    </form>
    
    <?
}

else
    echo "You must log in to post a comment.";

?>


    <?php include("content/footer.php"); ?>