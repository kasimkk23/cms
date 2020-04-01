<table class="table table-bordered table-hover table-dark">
                          <thead>
                            <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Author</th>
                              <th scope="col">Title</th>
                              <th scope="col">Category</th>
                              <th scope="col">Status</th>
                              <th scope="col">Image</th>
                              <th scope="col">Tags</th>
                              <th scope="col">Comments</th>
                              <th scope="col">Date</th>
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
                                echo "<th scope='row'>" . $id++ . "</th>";
                                echo "<td>{$post_author}</td>";
                                echo "<td>{$post_title}</td>";
                                echo "<td>{$post_category_id}</td>";
                                echo "<td>{$post_status}</td>";
                                echo "<td><img style='width:60px;' class='img-responsive img-fluid img-thumbnail' src='../images/$post_image'></td>";
                                echo "<td>{$post_tags}</td>";
                                echo "<td>{$post_comment_count}</td>";
                                echo "<td>{$post_date}</td>";

                                echo "</tr>"; 
                            }
                            ?>
                          </tbody>
                        </table>