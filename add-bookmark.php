<?php
  // Fetching all the Functions and DB Code
  require('./includes/functions.inc.php');
  require('./includes/database.inc.php');
  
  // Creates a session or resumes the current one based on a session identifier. 
  session_start();

  // If user not logged in
  if(!isset($_SESSION['USER_LOGGED_IN'])) {
    
    // Redirected to login page along with a message
    alert('Please log in to Add Bookmarks');
    redirect('./user-login.php');
  }

  // If we dont get article_id from URL
  if(!isset($_GET['id'])) {
    
    // Redirect to home page
    alert('Article not Found');
    redirect('./index.php');
  }

  // If we get article_id from URL and it is not null
  if (isset($_GET['id']) && $_GET['id'] !== '') {

    // Store the article_id as an integer
    $article_id = intval($_GET['id']);
  } else {

    // Redirect if article_id is missing or empty
    alert('Article not Found');
    redirect('./index.php');
  }

  // Article Query to fetch all the article data for respective article id
  $articleQuery = " SELECT *
                    FROM article
                    WHERE article_id = {$article_id} 
                    AND article_active = 1";
  
  // Running the Article Query
  $res = mysqli_query($con, $articleQuery);
  
  // Returns the number of rows from the result retrieved.
  $row = mysqli_num_rows($res);

  // If no article found with respective article id
  if($row == 0) {
    
    // Redirect to home page
    redirect('./index.php');
  }

  // Check if the bookmark already exists for this user and article
  $checkBookmarkQuery = $con->prepare("SELECT * FROM bookmark WHERE user_id = ? AND article_id = ?");
  $checkBookmarkQuery->bind_param("ii", $_SESSION['USER_ID'], $article_id);
  $checkBookmarkQuery->execute();
  $checkResult = $checkBookmarkQuery->get_result();

  // If the bookmark exists, remove it (delete the bookmark)
  if ($checkResult->num_rows > 0) {

      // Bookmark found, proceed to remove it
      $deleteBookmarkQuery = $con->prepare("DELETE FROM bookmark WHERE user_id = ? AND article_id = ?");
      $deleteBookmarkQuery->bind_param("ii", $_SESSION['USER_ID'], $article_id);
      
      if ($deleteBookmarkQuery->execute()) {
        
          // Bookmark removed successfully
          alert("Bookmark Removed Successfully");
          redirect('./bookmarks.php');
      } else {

          // Error occurred while removing the bookmark
          alert("Try Again Later");
          redirect('./index.php');
      }

  } else {

      // If the bookmark does not exist, proceed to add it
      $insertBookmarkQuery = $con->prepare("INSERT INTO bookmark (user_id, article_id) VALUES (?, ?)");
      $insertBookmarkQuery->bind_param("ii", $_SESSION['USER_ID'], $article_id);
      
      if ($insertBookmarkQuery->execute()) {

          // Bookmark added successfully
          alert("Bookmark Added Successfully");
          redirect('./bookmarks.php');
      } else {

          // Error occurred while adding the bookmark
          alert("Try Again Later");
          redirect('./index.php');
      }
  }

  // Close the prepared statements
  $checkBookmarkQuery->close();
  $deleteBookmarkQuery->close();
  $insertBookmarkQuery->close();

?>