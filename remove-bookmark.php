<?php
  require('./includes/functions.inc.php');
  require('./includes/database.inc.php');
  
  session_start();
  
  // If user not logged in
  if(!isset($_SESSION['USER_LOGGED_IN'])) {
    
    redirect('./user-login.php');
  }
  
  // If we dont get article_id from URL
  if(!isset($_GET['id'])) {

    redirect('./index.php');
  }
  
  // If we get article_id from URL and it is null
  elseif ($_GET['id'] == '') {

    redirect('./index.php');
  }

  // If we get article_id from URL and it is not null
  else {

    $article_id = $_GET['id'];
  }
  
  // Article Query to fetch all the article data for respective article id
  $articleQuery = " SELECT *
                    FROM article
                    WHERE article_id = {$article_id} 
                    AND article_active = 1";
    
  $res = mysqli_query($con, $articleQuery);
  
  $row = mysqli_num_rows($res);

  // If no article found with respective article id
  if($row == 0) {

    redirect('./index.php');
  }

  // Bookmark Query to delete or remove bookmark record for the particular user and article
  $bookmarkQuery = " DELETE FROM bookmark 
                    WHERE user_id = {$_SESSION['USER_ID']}
                    AND article_id = {$article_id}";


  $result = mysqli_query($con, $bookmarkQuery);
  
  //If Query ran successfully
  if($result) {

    alert("Bookmark Removed Successfuly");
    redirect('./index.php');
  }
  
  // If the Query failed
  else {
        
    alert('Try Again Later');
    redirect('./index.php');
  }

?>