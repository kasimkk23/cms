<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">CMS - Articles</h1>

            <?php

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if($page == "" || $page == 1){
                $page_1 = 0;
            } else {
                $page_1 = ($page * 5) - 5;
            }






            // number of rows in the database || Pagination System
            $post_query_count = "SELECT * FROM posts";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = ceil(mysqli_num_rows($find_count)/5);






                $query = "SELECT * FROM posts LIMIT $page_1, 5";
                $select_all_posts = mysqli_query($connection, $query); 
                while ($row = mysqli_fetch_assoc($select_all_posts)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 200);
                    $post_status = $row['post_status'];

                    if($post_status == 'published' ) {

            ?>
            
                

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p> by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></p>
                <p><span class="glyphicon glyphicon-time"></span> 
                    <?php 
                    echo date('d-m-Y', strtotime($post_date));
                    ?>
                </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php }  } ?>

                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->
        <hr>

        <nav aria-label="Page navigation example">
          <ul class="pagination">

            <?php
            for ($i=1; $i <= $count; $i++) { 
                // active tap
                if($i == $page){
                echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}''>{$i}</a></li>";    
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}''>{$i}</a></li>";
                }
            }
            ?>
          </ul>
        </nav>

        <!-- Footer -->
        <?php  include "includes/footer.php" ?>
