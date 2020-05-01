<?php include 'includes/admin_header.php'; ?>
<?php ob_start(); ?>


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
                <div class="col-md-4">

                    <?php insert_categories(); ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <input type="cat_title" class="form-control" name="cat_title" placeholder="Add Categories">
                          </div>
                          <button type="submit" name="submit" class="btn btn-primary">Add Categories</button>
                    </form>

                    <?php  // updating categories and including
                    if (isset($_GET['edit'])) {
                        $cat_id = $_GET['edit'];
                        include 'includes/update_categories.php';
                    }

                    ?>

                </div>
                <div class="col-md-8">
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
                        findAllCategories(); ?>

                        <?php // Deleting category
                        deleteCategories();  ?>

                        </tr>
                      </tbody>
                    </table>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include 'includes/admin_footer.php'; ?>