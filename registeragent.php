<?php


include('connection.php');

if($_SERVER['REQUEST_METHOD']==='POST'){


    $agentname=$_POST['agentname'];
    $agentpromocode=$_POST['agentpromocode'];
    $agentpassword=$_POST['agentpassword']; 

    $phone=$_POST['phone'];
    $agentType=$_POST['agentType'];
    $parentFacility=$_POST['parentFasilitator'];

    $increaptedpassword=md5($agentpassword);
    $sqlinsert="INSERT INTO `agent` (agent_id, username, password, phone_no,Type,parent_id) VALUES(?,?,?,?,?,?) ";
    $stmtageent=$conn3->prepare($sqlinsert);


    $stmtageent->bind_param("sssiii", $agentpromocode, $agentname, $increaptedpassword,$phone,$agentType,$parentFacility);

    $stmtageent->execute();

    $result=$stmtageent->get_result();


    if($result->num_rows>0){
        echo "Agent registered successfully";


    }
    else{
        echo "error in registration";
    }
}

$stmtageent->close();
$conn3->close();


?>