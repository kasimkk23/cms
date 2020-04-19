<?php 
if (isset($_POST['checkBoxArray'])) {
  foreach ( $_POST['checkBoxArray'] as $postValueId ) {
    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {
      case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
        $update_to_published_status = mysqli_query($connection, $query);
        if(!$update_to_published_status){
          die("Query Failed. ". mysqli_error($connection));
        }
        break;

        case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
        $update_to_draft_status = mysqli_query($connection, $query);
        if(!$update_to_draft_status){
          die("Query Failed. ". mysqli_error($connection));
        }
        break;

        case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
        $delete_post = mysqli_query($connection, $query);
        if(!$delete_post){
          die("Query Failed. ". mysqli_error($connection));
        }
        break;
      
      default:
        # code...
        break;
    }

  }
}
?>

<form action="" method="post">
<table class="table table-bordered table-hover table-dark">
  <div id="bulkOptionContainer" class="col-xs-4">
    <select class="form-control" name="bulk_options" id="">
      <option value="">Select Options</option>
      <option value="published">Published</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
    </select>
  </div>
  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" name="checkBoxArray" value="Apply">
    <a href="add_posts.php" class="btn btn-primary">Add New</a>
  </div><br><br>

      <thead>
        <tr>
          <th scope="col"><input id="selectAllBoxes" name="selectAllBoxes" class='checkboxes' type='checkbox'></th>
          <th scope="col">Id</th>
          <th scope="col">Author</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Status</th>
          <th scope="col">Image</th>
          <th scope="col">Tags</th>
          <th scope="col">Comments</th>
          <th scope="col">Date</th>
          <th scope="col" colspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);

        $id = 0;
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
            

            echo "<tr>";
            ?>

            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

            <?php
            echo "<th scope='row'>" . $id++ . "</th>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            // Showing name instead of category ID
            $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
            $select_categories_id = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_categories_id)){
                $the_cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            
            echo "<td>{$cat_title}</td>";
            }

            echo "<td>{$post_status}</td>";
            echo "<td><img style='width:60px;' class='img-responsive img-fluid img-thumbnail' src='../images/$post_image'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";

            echo "</tr>"; 
        }
        ?>
      </tbody>
    </table>
    </form>
    <?php 

    if (isset($_GET['delete'])) {
      $the_post_id = $_GET['delete'];

      $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
      $delete_query = mysqli_query($connection, $query);
      confirmquery($delete_query);
      header("Location: posts.php");
    }

    ?>