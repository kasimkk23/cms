<?php 
if(isset($_GET['p_id'])){
  $the_post_id = $_GET['p_id'];

  $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
  $select_posts = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($select_posts)) {
      $post_id = $row['post_id'];
      $post_author = $row['post_author'];
      $post_title = $row['post_title'];
      $post_category_id = $row['post_category_id'];
      $post_status = $row['post_status'];
      $post_image = $row['post_image'];
      $post_tags = $row['post_tags'];
      $post_comment_count = $row['post_comment_count'];
      $post_date = $row['post_date'];
      $post_content = $row['post_content'];
  }

  // Updating the edited post
  if (isset($_POST['update_post'])) {

  $post_title = $_POST['title'];
  $post_author = $_POST['post_author'];
  $post_category_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  $post_content = $_POST['post_content'];
  $post_tags = $_POST['post_tags'];
  
  $post_date = date('d-m-y');
  $post_comment_count = 4;

  move_uploaded_file($post_image_temp, "../images/$post_image");

  // we have us this because of broken image when we update the post.
  if (empty($post_image)) {
    $query = "SELECT * FROM posts";
    $select_image = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_image)) {
      $post_image = $row['post_image'];
    }
  }

  $query = "UPDATE posts SET ";
  $query.= "post_category_id ='{$post_category_id}' , ";
  $query.= "post_title ='{$post_title}', ";
  $query.= "post_author ='{$post_author}', ";
  $query.= "post_date = now(), ";
  $query.= "post_image ='{$post_image}', ";
  $query.= "post_content ='{$post_content}', ";
  $query.= "post_tags ='{$post_tags}', ";
  $query.= "post_status ='{$post_status}' ";
  $query.= "WHERE post_id ='{$the_post_id}' ";

  $update_post = mysqli_query($connection, $query);
  confirmQuery($update_post);

  echo "<div class='alert alert-success'>
  <strong>Success!</strong> You have edited a post:  <a href='../post.php?p_id={$the_post_id}' class='alert-link'>View Post</a>. <small>All other posts : </small><a href='post.php' class='alert-link'>View all posts</a>.
</div>";


  }
}
?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="col-md-8">
    <div class="form-group">
      <label for="title">Post Title</label>
      <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="title">
    </div>

    <div class="form-group">
    <label>Categories </label>
    <select name="post_category" class="form-control custom-select my-1 mr-sm-2" id="post_category">        

    <?php 
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        confirmQuery($select_categories);

        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            echo "<option value='{$cat_id}'>{$cat_title}</option>";

        }
    ?>

    </select>

    </div>
    <div class="form-group">
      <label for="post_author">Post Author</label>
      <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author">
    </div>

    
    <div class="form-group">
    <label>Post Status </label>
    <select name="post_status" class="form-control custom-select my-1 mr-sm-2" id="post_status">
      
    <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?> </option>

    <?php 
    if ($post_status == 'published') {
      echo "<option value='draft'>Draft</option>";
    } else {
      echo "<option value='published'>Publish</option>";
    }
    ?>

    </select>

    </div>


    <div class="form-group">
      <label for="post_image">Post Image</label>
      <input type="file" class="form-control" name="image">
      <img width='100' class='img-responsive img-fluid img-thumbnail' src="../images/<?php echo $post_image ?>">
    </div>
    <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
      <label for="post_content">Post Content</label>
      <textarea type="text" class="form-control" name="post_content" col='30' rows="10"><?php echo $post_content; ?>
      </textarea>
    </div>

      <button type="submit" class="btn btn-primary" name="update_post">Update Post</button>
  </div>


</form>