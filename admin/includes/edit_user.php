<?php 

if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
      $select_users_query = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($select_users_query)) {
          $user_id = $row['user_id'];
          $username = $row['username'];
          $user_password = $row['user_password'];
          $user_firstname = $row['user_firstname'];
          $user_lastname = $row['user_lastname'];
          $user_email = $row['user_email'];
          $user_image = $row['user_image'];
      }
}

if(isset($_POST['update_user'])){

  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];

  // $post_image = $_FILES['image']['name'];
  // $post_image_temp = $_FILES['image']['tmp_name'];

  $username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  
  // move_uploaded_file($post_image_temp, "../images/$post_image");

  if(!empty($user_password)){
     $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
     $get_user_password = mysqli_query($connection, $query_password);
     if(!$get_user_password){
      die("Query FAILED . ". mysqli_error($connection));
     }

     $row = mysqli_fetch_array($get_user_password);
     $db_user_password = $row['user_password'];

     if($db_user_password != $user_password){
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=> 10));

  }
  $query = "UPDATE users SET ";
  $query.= "username ='{$username}', ";
  $query.= "user_password ='{$hashed_password}', ";
  $query.= "user_firstname ='{$user_firstname}', ";
  $query.= "user_lastname ='{$user_lastname}', ";
  $query.= "user_email ='{$user_email}', ";
  $query.= "WHERE user_id = {$the_user_id} ";

  $update_user = mysqli_query($connection, $query);
  if(!$update_user){
    die("Query failed" . mysqli_error($connection));
  }

  echo "<div class='alert alert-success'>
  <strong>Success!</strong> You have edited a user:  <a href='users.php' class='alert-link'>View posts</a>.
</div>";
  }

  


  

}

?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Username</label>
    <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
  </div>
  <div class="form-group">
    <label for="title">First Name</label>
    <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
  </div>
  <div class="form-group">
    <label for="title">Last Name</label>
    <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
  </div>

  <!-- <div class="form-group">
      <label>User Role  </label>
      <select name="user_role" class="custom-select my-1 mr-sm-2" id="user_role">
        <option value="<?php //echo $user_role; ?>"><?php //echo $user_role; ?></option>

        <?php
        //if($user_role == 'admin'){
        //echo "<option value='subscriber'>subscriber</option>";
        //} //else {
        //echo "<option value='admin'>admin</option>";
        //}
        ?>
    </select><br>
  </div> -->


  <div class="form-group">
    <label for="post_author">User Email</label>
    <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
  </div>
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" autocomplete="off" class="form-control" name="user_password">
  </div>
  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div> -->
  

  <button type="submit" class="btn btn-primary" name="update_user">Update User</button>
</form>
 
