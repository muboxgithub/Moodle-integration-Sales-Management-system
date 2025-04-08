<?php

include('connection3.php');


$sqlquestion="SELECT COUNT(id) AS question FROM `ad_downloadmodule` WHERE `type`=2";


$stmt=$conn33->prepare($sqlquestion);

$stmt->execute();
$result=$stmt->get_result();


if($result->num_rows >0){

    $row=$result->fetch_assoc();

    $question=$row['question'];
    echo "$question";
    exit;
}
else{
    echo "error";
    exit;
}



?>