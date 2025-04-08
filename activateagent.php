<?php

include('connection.php');


$agentid = $_POST['agentid'];
$sql = "UPDATE agent SET status =1 WHERE `id`=$agentid";

$stmt=$conn3->prepare($sql);

$stmt->execute();
$result=$stmt->get_result();


if($result->num_rows>0){

    echo "success";
}
else{
    echo "failed";
}

?>