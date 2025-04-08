<?php
include('connection3.php');



$sqlselect="SELECT COUNT(id) AS dawnloadlesson FROM `ad_downloadmodule` WHERE `type`=1";



$stmt=$conn33->prepare($sqlselect);


$stmt->execute();

$result=$stmt->get_result();


if($result->num_rows >0){
    $row=$result->fetch_assoc();


    $totlesson=$row['dawnloadlesson'];
    echo "$totlesson";
    exit;
}
else{
    echo "error";
    exit;
}



?>