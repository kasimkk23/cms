      <table class="table table-bordered table-hover table-dark">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Username</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col" colspan="2">Waiting</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $query = "SELECT * FROM users";
          $select_users = mysqli_query($connection, $query);

          $id = 0;
          while ($row = mysqli_fetch_assoc($select_users)) {
              $user_id = $row['user_id'];
              $username = $row['username'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];
              $user_image = $row['user_image'];
              $user_role = $row['user_role'];

              echo "<tr>";
              echo "<th scope='row'>" . $id++ . "</th>";
              echo "<td>{$username}</td>";
              echo "<td>{$user_firstname}</td>";
              echo "<td>{$user_lastname}</td>";
              echo "<td>{$user_email}</td>";

              //echo "<td>{$user_image}</td>";
              echo "<td>{$user_role}</td>";

              echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
              echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";

              echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
              echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";

              echo "</tr>"; 
          }
          ?>
        </tbody>
      </table>
    <?php 

    // change_to_admin
    if (isset($_GET['change_to_admin'])) {
      $the_user_id = $_GET['change_to_admin'];

      $query = "Update users SET user_role = 'admin' WHERE user_id = $the_user_id";
      $change_to_admin_query = mysqli_query($connection, $query);
      if(!$change_to_admin_query){
        die("Query failed" . mysqli_error($connection));
      }
      header("Location: users.php");
    }

    // change_to_subscriber
    if (isset($_GET['change_to_sub'])) {
      $the_user_id = $_GET['change_to_sub'];

      $query = "Update users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
      $change_to_subs_query = mysqli_query($connection, $query);
      if(!$change_to_subs_query){
        die("Query failed" . mysqli_error($connection));
      }
      header("Location: users.php");
    }

    // delete users
    if (isset($_GET['delete'])) {
      if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] === 'admin'){

      $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

      $query = "DELETE FROM users WHERE user_id={$the_user_id}";
      $delete_user = mysqli_query($connection, $query);
      if(!$delete_user){
        die("Query failed" . mysqli_error($connection));
      }
      header("Location: users.php");

        }
      }
    }
    ?>