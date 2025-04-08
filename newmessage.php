<?php



include('connection3.php');


$sqlmessage="SELECT COUNT(id) AS newmessage FROM `messages` WHERE `view`=0";


$stmt=$conn33->prepare($sqlmessage);
$stmt->execute();

$resultmessage=$stmt->get_result();


if($resultmessage->num_rows >0){

    $row=$resultmessage->fetch_assoc();

    $totnewmessage=$row['newmessage'];
    echo "$totnewmessage";
    exit;
}else{


    echo "error courred for fetchign the new message";
}

?>