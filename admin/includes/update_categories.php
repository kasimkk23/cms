<form action="" method="post">
    <div class="form-group">
        <?php
        if(isset($_GET['edit'])){
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $select_categories_id = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_categories_id)){
                $the_cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            }?>
            <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="cat_title" class="form-control" name="cat_title" placeholder="Edit Categories">
        <?php } ?>

        <?php // Updating category
        if(isset($_POST['cat_title'])){
        $the_cat_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$the_cat_id}";
        $update_query = mysqli_query($connection, $query);
        if (!$update_query) {
            die("Update Query Failed". mysqli_error($connection));
        } 
        echo "<div class='alert alert-success'>
          <strong>Success!</strong> You have updated a category:  <a href='./categories.php' class='alert-link'>View Categories</a>.
        </div>";
    }
    ?>
    </div>
    <button type="submit" name="update_category" class="btn btn-primary">Update Category</button>
</form>