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

        case 'clone':
        $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
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

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";

        $query .= " VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";

        $clone_post_query = mysqli_query($connection, $query);
        confirmquery($clone_post_query);



      
      default:

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
      <option value="clone">Clone</option>
      <option value="delete">Delete</option>
    </select>
  </div>
  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" name="checkBoxArray" value="Apply">
    <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
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
          <th scope="col">View Post</th>
          <th scope="col">Views</th>
          <th scope="col" colspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($connection, $query);

        $id = 1;
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
            $post_views_count = $row['post_views_count'];
            

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
            $date=date_create($post_date);
            $post_date = date_format($date,"Y/m/d");

            echo "<td>{$post_status}</td>";
            echo "<td><img style='width:60px;' class='img-responsive img-fluid img-thumbnail' src='../images/$post_image'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a onclick=\" javascript: return confirm('Are you sure you want to delete it?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";

            echo "</tr>"; 
        }
        ?>
      </tbody>
    </table>
    </form>
    <?php 

    // delete a post
    if (isset($_GET['delete'])) {
      $the_post_id = $_GET['delete'];

      $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
      $delete_query = mysqli_query($connection, $query);
      confirmquery($delete_query);
      header("Location: posts.php");
    }

    // reset views count
    if (isset($_GET['reset'])) {
      $the_post_id = $_GET['reset'];

      $query = "UPDATE posts SET post_views_count = 0  WHERE post_id= " .mysqli_real_escape_string($connection, $_GET['reset']) . " ";
      $reset_query = mysqli_query($connection, $query);
      confirmquery($reset_query);
      header("Location: posts.php");
    }

    ?>