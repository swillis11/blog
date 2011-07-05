<?php include_once("content/header.php"); ?>

<div id="main" >

<?php

$tid=$_GET['tid'];

$result = mysql_query("SELECT Tags.tid,Tags.name, Post.uid,Post.pid,Post.Description,Post.Title, Users.firstname,Users.lastname 
                    FROM Post,Users,PostTag,Tags WHERE Tags.tid=PostTag.tid 
                    AND Users.uid=Post.uid 
                    AND PostTag.pid=Post.pid 
                    AND Tags.tid='$tid' 
                    ORDER BY DateCreated DESC")
                                       or die(mysql_error());

$tagquery = mysql_query("SELECT Tags.name FROM Tags WHERE Tags.tid=$tid");
$tagarray = mysql_fetch_array($tagquery);

echo "Displaying posts tagged as ".$tagarray['name'].".";
        

while($row = mysql_fetch_array($result)){

 echo "<div class='post'>\n";
 echo 	"<h2> ".$row['Title']." </h2>\n";
 echo 	"<p> ".$row['firstname']." ".$row['lastname']. " at ".$row['DateCreated']." </p>\n";  //change to date modified.
 echo 	"<p> ".$row['Description']." </p>\n";
 

 echo "tags:";

  $tagquery = "SELECT Tags.name,Tags.tid FROM Tags,Post,PostTag WHERE Post.pid=PostTag.pid 
                AND PostTag.pid='".$row['pid']."' AND PostTag.tid=Tags.tid;";

  $tagresult=mysql_query($tagquery);
  $commentsresult = mysql_query("SELECT * FROM Comments,Post WHERE Comments.pid=".$row['pid']."");

 
 while($tags = mysql_fetch_array($tagresult))
    echo "<a href='view.php?tid=".$tags['tid']."'> ".$tags['name']."</a>";   

 
 if($_SESSION['loggedin']==true) {
   if(($_SESSION['userid']==$row['uid']) || $_SESSION['userlevel']==1){       
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