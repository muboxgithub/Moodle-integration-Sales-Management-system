<?php


$server_name = "localhost";
$username = "etemar5_mood229";
$password = "S4@66Ss)1p";
$dbname = "etemar5_mood229";
 
$conn2 = mysqli_connect($server_name, $username, $password, $dbname);
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}




?>