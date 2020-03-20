<?php 
// if(isset($_POST['submit'])){
//     $username = $_POST['username'];
//     $passcode = $_POST['password'];

    // connect to database
    $connection = mysqli_connect('localhost','root','','cms2020');
    if($connection){
        echo "We are connected";
    } else {
        echo "Connection failed!";
    }

    // insert data to database
    // $query = "INSERT INTO user(username, passcode)";
    // $query .= "VALUES ('$username', '$passcode')";

    $query = "SELECT * FROM user";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query failed" . mysqli_error($connection));
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
<?php
while($row = mysqli_fetch_assoc($result)){
    print_r($row);
} 
print_r($_GET);
print_r($_POST);

?>
<a href="test.php?id=200"> click </a>
    <!-- <form action="test.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form> -->
</div>
</body>
</html>