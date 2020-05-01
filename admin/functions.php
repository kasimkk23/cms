<?php 

function confirmQuery($result){

    global $connection;
    
    if(!$result){
    die("Query failed " . mysqli_error($connection));
  }
}

// check how many users are online
function users_online(){

    global $connection;

    $session = session_id();
    $user_time = time();
    $time_out_in_seconds = 30;
    $time_out = $user_time - $time_out_in_seconds;

    $query = "SELECT * from users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL){
        mysqli_query($connection, "INSERT INTO users_online(session, user_time) VALUES('$session','$user_time')");
    } else {
        mysqli_query($connection,"UPDATE users_online SET user_time = '$user_time' WHERE session = '$session' ");
    }

    $users_online_query = "SELECT * FROM users_online WHERE user_time > $time_out ";
    $count_query = mysqli_query($connection, $users_online_query);

    return $count_user = mysqli_num_rows($count_query);

}

function insert_categories(){

	global $connection;

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
}

function findAllCategories() {
	global $connection;
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
}

function deleteCategories() {
	global $connection;

	if(isset($_GET['delete'])){
	    $the_cat_id = $_GET['delete'];
	    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
	    $delete_query = mysqli_query($connection, $query);
	    header('Location: categories.php');
	}

}

?>