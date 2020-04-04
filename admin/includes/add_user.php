<?php 
if(isset($_POST['create_user'])){

  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];

  // $post_image = $_FILES['image']['name'];
  // $post_image_temp = $_FILES['image']['tmp_name'];

  $username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  
  // move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role)";
  $query .= "VALUES( '{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}' )";

  $create_user_query = mysqli_query($connection, $query);
  
  confirmQuery($create_user_query);

}

?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  <div class="form-group">
    <label for="title">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>
  <div class="form-group">
    <label for="title">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
      <label>User Role  </label>
      <select name="user_role" class="custom-select my-1 mr-sm-2" id="post_category">
        <option value="subscriber">Select option</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select><br>
  </div>


  <div class="form-group">
    <label for="post_author">User Email</label>
    <input type="text" class="form-control" name="user_email">
  </div>
  <div class="form-group">
    <label for="">Password</label>
    <input type="text" class="form-control" name="user_password">
  </div>
  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div> -->
  

  <button type="submit" class="btn btn-primary" name="create_user">Add User</button>
</form>