

<?php



$hostname='localhost';

$user='etemar5_mood435';
$password = "(S9X8-W3pH";
$dbname = "etemar5_transaction";




$conn3=mysqli_connect($hostname,$user,$password,$dbname);


if($conn3->error){


    echo "errror ocurred".$conn->error;
}





?>