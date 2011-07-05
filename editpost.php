<?php include("content/header.php"); ?>

<div id="main" >

<?php

//$pid=$_SESSION['postid'];
$pid=$_GET['pid'];
$delete=$_GET['delete'];
$addpost=$_GET['addpost'];

$result = mysql_query("SELECT Title,Text,Users.uid,level FROM Post,Users WHERE pid='$pid' AND Post.uid=Users.uid") or die(mysql_error());
$row    = mysql_fetch_array($result);

//Now check session.UID to make sure it matches the owner/uid of the post otherwise they cannot change it.
if(($_SESSION['userid']==$row['uid'] || $addpost) && $_SESSION['loggedin']){
   
    $title=$row['Title'];
    $text=$row['Text'];

    //Imported along with '$_POST['Post']' from the html form below.
    $edit = $_POST['Edit'];
    $edittitle = $_POST['EditTitle'];
    $descr= substr($edit, 0, 250);  //Character length for the short description
    $id   = $_POST['Id'];
    
     
  if(!$delete && !$addpost){
  ?> 
    <form action="editpost.php?pid=<?echo $pid?>" method='POST'>
	<h2>Edit Post</h2>
	<ul>
		<li>
			<label for='title'>Title</label>
			<input id='title' type='text' name='EditTitle' value='<?echo $title?>' />
		</li>
		
		<li>
			<label for='body'>Body</label>
			<textarea id='body' name='Edit' ><?echo $text?></textarea>
		</li>
		
		<input type='submit' name='Post' value='Submit' />
		
	</ul>
    </form>
    
  <?
    if (isset($_POST['Post']))
    { 

        if (!empty($edit))
        {
            
        mysql_query("UPDATE Post SET Title='$edittitle',Text='$edit',Description='$descr' WHERE pid='$pid'") or die(mysql_error());
        
        unset($_POST);
        
        header("Location: index.php");
        sleep(1);
        //die("Your post has been successfully edited.<br />");
        
        }
        else
            echo "You must fill in the edit body part of the form first.";
 
    }
    
    else
        echo "You must submit the edit form first.";    
  }
  
  else if($delete == 1 && $addpost != 1){
      
      mysql_query("DELETE FROM Post WHERE pid=$pid") 
                                        or die(mysql_error()); 
      
      header('Location: index.php');
      
  }
      
  else if($addpost == 1 && $delete != 1){ //add new post
      if (isset($_POST['Post'])){ //Creates the post
         
         mysql_query("INSERT INTO Post(uid,Title,Text,Description)
                VALUES('".$_SESSION['userid']."','".$_POST['Title']."','".$_POST['Text']."','".$_POST['Text']."')")
                                                                                                  or die(mysql_error());
    
          unset($_POST);
          
          sleep(1);
          header("Location: index.php");
      }
      
      
      
      
      ?>
    
    <form action='editpost.php?addpost=1' method='POST'>
	<h2>New Post</h2>
	<ul>
		<li>
			<label for='title'>Title</label>
			<input id='title' type='text' name='Title' />
		</li>
		
		<li>
			<label for='body'>Body</label>
			<textarea id='body' name='Text'> </textarea>
		</li>
		
		<input type='submit' name='Post' value='Submit' />
		
	</ul>
    </form>
      
      
      <?
  }
  
  else
     header('Location: index.php');


  }



else
    echo "<p class='warningtext'>You are not authorized to edit this post. </p>";

 

  mysql_close($con);
?>
    <?php include("content/footer.php"); ?>