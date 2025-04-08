<?php


include('connection.php');



if($_SERVER['REQUEST_METHOD']==='POST'){



    $agentcode = $_POST['agentcode'];

    $agentid = $_POST['agentid'];


    $sqlchecsql="SELECT * FROM `agent` WHERE `id`=?";

    $stmt=$conn3->prepare($sqlchecsql);
    $stmt->bind_param("i",$agentid);


$resultid=$stmt->execute();
$resultid=$stmt->get_result();


if($resultid->num_rows >0){


    $row=$resultid->fetch_assoc();

    $agentcodedb=$row['agent_id'];


    $sqlcheckagentcode="SELECT * FROM `agent` WHERE `agent_id`=? AND `agent_id` != ?";


    $stmtagentcode=$conn3->prepare($sqlcheckagentcode);


    $stmtagentcode->bind_param("ss",$agentcode,$agentcodedb);


    $resultagentcode=$stmtagentcode->execute();

    $resultagentcode=$stmtagentcode->get_result();
    if($resultagentcode->num_rows >0){



        echo "true";
    }
    else{
        echo "false";
    }
}
}


$stmt->close();

$stmtagentcode->close();
$conn3->close();




?>