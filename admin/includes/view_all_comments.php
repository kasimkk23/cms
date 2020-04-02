<table class="table table-bordered table-hover table-dark">
                          <thead>
                            <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Author</th>
                              <th scope="col">Comment</th>
                              <th scope="col">Email</th>
                              <th scope="col">Status</th>
                              <th scope="col">In Response to</th>
                              <th scope="col">Date</th>
                              <th scope="col" colspan="2">Waiting</th>
                              <th scope="col" colspan="2">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $query = "SELECT * FROM comments";
                            $select_comments = mysqli_query($connection, $query);

                            $id = 0;
                            while ($row = mysqli_fetch_assoc($select_comments)) {
                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_author = $row['comment_author'];
                                $comment_content = substr($row['comment_content'], 0,15);
                                $comment_email = $row['comment_email'];
                                
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];
                                

                                echo "<tr>";
                                echo "<th scope='row'>" . $id++ . "</th>";
                                echo "<td>{$comment_author}</td>";
                                echo "<td>{$comment_content}</td>";

                                // // Showing name instead of category ID
                                // $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                                // $select_categories_id = mysqli_query($connection, $query);
                                // while($row = mysqli_fetch_assoc($select_categories_id)){
                                //     $the_cat_id = $row['cat_id'];
                                //     $cat_title = $row['cat_title'];
                                
                                // echo "<td>{$cat_title}</td>";
                                // }

                                echo "<td>{$comment_email}</td>";
                                echo "<td>{$comment_status}</td>";
                                echo "<td>Response</td>";
                                echo "<td>{$comment_date}</td>";
                                echo "<td><a href='posts.php?source=edit_post&p_id='>Approve</a></td>";
                                echo "<td><a href='posts.php?delete='>Unapprove</a></td>";

                                echo "<td><a href='posts.php?source=edit_post&p_id='>Edit</a></td>";
                                echo "<td><a href='posts.php?delete='>Delete</a></td>";

                                echo "</tr>"; 
                            }
                            ?>
                          </tbody>
                        </table>
    <?php 

    // if (isset($_GET['delete'])) {
    //   $the_post_id = $_GET['delete'];

    //   $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
    //   $delete_query = mysqli_query($connection, $query);
    //   confirmquery($delete_query);
    // }

    ?>