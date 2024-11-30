<?php
  require('./includes/nav.inc.php');
  
  // Checking if the User is logged in
  if(!isset($_SESSION['USER_LOGGED_IN'])) {

    // If user not logged in Redirect to login page
    alert("Please Login to Change your password");
    redirect('./user-login.php');
  }

  // Fetching user data from Session variable
  $user_id = $_SESSION['USER_ID'];


  if(isset($_POST['submit'])) {

    // Fetching values via POST and passing them to user defined function to get rid of special characters used in SQL
    $old_password = get_safe_value($_POST['old_password']);
    $new_password = get_safe_value($_POST['new_password']);
    $confirm_new_password = get_safe_value($_POST['confirm_new_password']);
    
    // Creating new password hash
    $str_new_pass = password_hash($new_password,PASSWORD_BCRYPT);
    
    // Query to check if the user is registered
    $sql = "SELECT * FROM user 
            WHERE user_id = {$user_id}";

    $result = mysqli_query($con,$sql);
    
    $rows = mysqli_num_rows($result);

    // If any user with the email exists
    if($rows > 0) {
    
      // Fetching the data of particular record as an Associative Array
      $data = mysqli_fetch_assoc($result);
      $email = $data['user_email'];

      $author_check_sql = "SELECT * FROM author 
                           WHERE author_email = '{$email}'";
      
      $author_check_result = mysqli_query($con, $author_check_sql);
      
      // Returns the number of rows from the result retrieved.
      $author_check_rows = mysqli_num_rows($author_check_result);

      // If email is not an author email
      if($author_check_rows == 0) {

        // Verifing whether the password matches the hash from DB
        $pasword_check = password_verify($old_password,$data['user_password']);
        
        // If password matches with the data from DB
        if($pasword_check) {

          // Update Query to update password of the user in DB
          $update_sql = " UPDATE user
                          SET user_password = '{$str_new_pass}'
                          WHERE user_id = {$user_id}";
    	    

          $update_result = mysqli_query($con,$update_sql);
          
          // If the Query failed
          if(!$update_result) {

            alert("Sorry. Try again later !");
            echo "Error: ".mysqli_error($con);
          }
          
          // If Query ran successfully
          else {

            alert("Password Updated !");
            redirect('./index.php');
          }
        }
      }

      // If email is an author email
      else {

        // Fetching the data of Author record as an Associative Array
        $author_check_data = mysqli_fetch_assoc($author_check_result);
        $author_id = $author_check_data['author_id'];

        // Verifing whether the password matches the hash from DB
        $pasword_check = password_verify($old_password,$data['user_password']);
        
        // If password matches with the data from DB
        if($pasword_check) {

          // Update Query to update password of the user and author in DB
          $update_sql = " UPDATE author, user
                          SET author.author_password = '{$str_new_pass}',
                          user.user_password = '{$str_new_pass}'
                          WHERE author_id = {$author_id}
                          AND user.user_email = '{$email}'";
  
          // Running Update Query 
          $update_result = mysqli_query($con,$update_sql);
          
          // If the Query failed
          if(!$update_result) {

            alert("Sorry. Try again later !");
            echo "Error: ".mysqli_error($con);
          }
          // If Query ran successfully
          else {

            alert("Password Updated !");
            redirect('./index.php');
          }
        }

        // If the password fails to match
        else {

          alert("Wrong Password. Try again !");
        }
      }
    }

    // If no user with email exists
    else {
      alert("Try again Later!");
      redirect('./user-login.php');
    }
  }

?>


<div class="container p-2">
  <!-- Container to store the form div -->
  <div class="forms-container">
    <!-- Div for password change -->
    <div class="left">
      <div class="form-title">
        <h4>Change Password</h4>
      </div>
      <div class="login-form-container">
        <!-- Form for Password change -->
        <form method="POST" class="login-form" id="change_pass_form">
          <div class="input-field">
            <input type="password" name="old_password" id="old_password" placeholder=" Old Password" autocomplete="off"
              required>
          </div>
          <div class="input-field">
            <input type="password" name="new_password" id="new_password" placeholder=" New Password" autocomplete="off"
              required>
          </div>
          <div class="input-field">
            <input type="password" name="confirm_new_password" id="confirm_new_password"
              placeholder=" Confirm New Password" autocomplete="off" required>
          </div>
          <div class="input-field">
            <button type="submit" name="submit">Login</button>
          </div>
        </form>
      </div>
      <!-- Div to display the errors from the form -->
      <div class="form-errors">
        <p class="errors" id="errors"></p>
      </div>
    </div>
  </div>
</div>

<script src="./assets/js/change-pass-validate.js"></script>

<?php

  require('./includes/footer.inc.php');
?>