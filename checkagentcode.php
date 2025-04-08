<?php
include('connection.php');




if($_SERVER['REQUEST_METHOD']=== 'POST'){


    $agentpromocode=$_POST['agentcode'];

    
$sqlcheckagentcode="SELECT * FROM  `agent` WHERE `agent_id`=?";

$stmt=$conn3->prepare($sqlcheckagentcode);

$stmt->bind_param('s',$agentpromocode);
$stmt->execute();
$result=$stmt->get_result();


if($result->num_rows> 0){


    echo "true";
}
else{
    echo "false";
}
}



$stmt->close();

$conn3->close();

?>