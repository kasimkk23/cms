<?php include 'includes/admin_header.php'; ?>
<?php include 'functions.php'; ?>
<?php ob_start(); ?>

<?php 
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}'";

    $select_user_profile_query = mysqli_query($connection, $query);
    if (!$select_user_profile_query) {
        die("Query Failed". mysqli_error($select_user_profile_query));
    }
    while($row = mysqli_fetch_array($select_user_profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
    
}
?>


<?php 
if(isset($_POST['update_user'])){

  echo $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];

  // $post_image = $_FILES['image']['name'];
  // $post_image_temp = $_FILES['image']['tmp_name'];

  $username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  
  // move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "UPDATE users SET ";
  $query.= "username ='{$username}', ";
  $query.= "user_password ='{$user_password}', ";
  $query.= "user_firstname ='{$user_firstname}', ";
  $query.= "user_lastname ='{$user_lastname}', ";
  $query.= "user_email ='{$user_email}', ";
  $query.= "user_role ='{$user_role}' ";
  $query.= "WHERE username = '{$username}' ";

  $update_user = mysqli_query($connection, $query);
  if(!$update_user){
    die("Query failed" . mysqli_error($connection));
  }

}
?>

<div id="wrapper">
        <!-- Navigation -->
<?php include 'includes/admin_navigation.php'; ?>
    
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>


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

                      <div class="form-group">
                          <label>User Role  </label>
                          <select name="user_role" class="custom-select my-1 mr-sm-2" id="user_role">
                            <option value="subscriber"><?php echo $user_role; ?></option>

                            <?php
                            if($user_role == 'admin'){
                            echo "<option value='subscriber'>subscriber</option>";
                            } else {
                            echo "<option value='admin'>admin</option>";
                            }
                            ?>
                        </select><br>
                      </div> 


                      <div class="form-group">
                        <label for="post_author">User Email</label>
                        <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                      </div>
                      <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
                      </div>
                      <!-- <div class="form-group">
                        <label for="post_image">Post Image</label>
                        <input type="file" class="form-control" name="image">
                      </div> -->
                      

                      <button type="submit" class="btn btn-primary" name="update_user">Update Profile</button>
                    </form>
 




                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include 'includes/admin_footer.php'; ?>