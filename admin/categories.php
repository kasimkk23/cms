<?php include 'includes/admin_header.php'; ?>

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
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-md-6">
                    <?php
                    if(isset($_POST['submit'])){
                       $cat_title = $_POST['cat_title'];

                       if($cat_title == "" || empty($cat_title)){
                        echo "This field must not be empty";
                       } else {
                        $query = "INSERT INTO categories(cat_title)";
                        $query.= "VALUE('$cat_title')";

                        $create_category_query = mysqli_query($connection, $query);

                        if(!$create_category_query){
                            die('Query Failed'. mysqli_error($connection));
                        }

                       }
                    } 
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="cat_title" class="form-control" name="cat_title" placeholder="Add Categories">
                          </div>
                          <button type="submit" name="submit" class="btn btn-primary">Add Categories</button>
                    </form>

                    <?php 
                    if (isset($_GET['edit'])) {
                        $cat_id = $_GET['edit'];
                        include 'includes/update_categories.php';
                    }

                    ?>




                    
                </div>
                <div class="col-md-6">
                    <table class="table table-dark">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Categories Title</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php // Find all the categories
                        $query = "SELECT * FROM categories";
                        $select_categories = mysqli_query($connection, $query);

                        $id = 0;
                        while ($row = mysqli_fetch_assoc($select_categories)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];

                            echo "<tr>";
                            echo "<th scope='row'>" . $id++ . "</th>";
                            echo "<td>{$cat_title}</td>";
                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                            echo "</tr>"; 
                        }
                        ?>
                        <?php // Deleting category
                        if(isset($_GET['delete'])){
                            $the_cat_id = $_GET['delete'];
                            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                            $delete_query = mysqli_query($connection, $query);
                            header('Location: categories.php');
                        }
                        ?>













                        </tr>
                      </tbody>
                    </table>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include 'includes/admin_footer.php'; ?>