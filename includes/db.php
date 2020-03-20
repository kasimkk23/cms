<?php

// Connecting to database
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = "";
$db['db_name'] = "cms";

// loop through every key and convert them to upper case
foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

// connect to database with message
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection) {
    echo "We are connected";
}