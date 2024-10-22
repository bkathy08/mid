<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "kathy_db";
//connection string to connect database
$conn = new mysqli($host, $user, $pass, $dbname);

 if($conn->connect_error)
 {
    die("Connection failed: ".$conn->connect_error);
 }

?>