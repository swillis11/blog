<?php include_once("content/header.php"); ?>

<div id="main" >

<?php

$result = mysql_query("SELECT * FROM Post,Users WHERE Post.uid=Users.uid ORDER BY DateCreated DESC") or die(mysql_error());
       

while($row = mysql_fetch_array($result)){

 $tagquery = "SELECT Tags.name,Tags.tid FROM Tags,Post,PostTag WHERE Post.pid=PostTag.pid 
                AND PostTag.pid='".$row['pid']."' AND PostTag.tid=Tags.tid;";

 $tagresult=mysql_query($tagquery);
 $commentsresult = mysql_query("SELECT * FROM Comments,Post WHERE Comments.pid=".$row['pid'].""); 
 
 echo "<div class='post'>\n";
 echo 	"<h2> ".$row['Title']." </h2>\n";
 echo 	"<p> ".$row['firstname']." ".$row['lastname']. " at ".$row['DateCreated']." </p>\n";  //change to date modified.
 echo 	"<p> ".$row['Description']." </p>\n";

 if(mysql_num_rows($tagresult)>0){
    echo "tags:";

    while($tags = mysql_fetch_array($tagresult))
      echo "<a href='view.php?tid=".$tags['tid']."'> ".$tags['name']."</a>";  
    
        if($_SESSION['loggedin']==true && $_SESSION['userid']=$row['uid']) {  
            echo "<a href='addtag.php?pid=".$row['pid']."&edit=1'>\nEdit Tags</a>"; 
        }   
    }
    
 if($_SESSION['loggedin']==true) {
   if(($_SESSION['userid']==$row['uid']) || $_SESSION['userlevel']==1){
       echo "<a href='addtag.php?pid=".$row['pid']."'>Add Tag</a>"; 
    echo "<p><a href='editpost.php?pid=".$row['pid']."'>Edit Post</a>";//Use get and set security in editpost.php

    echo "<a href='editpost.php?pid=".$row['pid']."&delete=1'>Delete Post</a></p>"; //send delete tag
 }   
    echo "<p><a href='comment.php?pid=".$row['pid']."'>Add Comment</a></p>";
 }
 
 if(mysql_num_rows($commentsresult)>0)
    echo "<p><a href='comment.php?pid=".$row['pid']."&view=1'>View Comments</a></p>";
                                                                  //so ?pid= can't be changed to anything.
 echo 	"</div>\n\n";
  	   	  
}
  mysql_close($con);  
 ?>

    <?php include("content/footer.php"); ?>