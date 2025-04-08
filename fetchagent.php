<?php

include('connection.php');



$sqlagent="SELECT * FROM `agent` ORDER BY `created_at` DESC";
$stmtagent=$conn3->prepare(($sqlagent));

$stmtagent->execute();
$resultstmt=$stmtagent->get_result();


$response=array();

if($resultstmt->num_rows>0){
    while($row=$resultstmt->fetch_assoc()){

        $parentdata='';


        $parentid=$row['parent_id'];
        $sqlparent="SELECT * FROM `agent` WHERE `id`=?";
        $stmtparent=$conn3->prepare($sqlparent);
        $stmtparent->bind_param("i",$parentid);
        $stmtparent->execute();
        $resultparent=$stmtparent->get_result();
        if($resultparent->num_rows >0){
            $rowparent=$resultparent->fetch_assoc();
            $parentdata=$rowparent['agent_id'];


        }
        else{
            $parentdata='Etemari';
        }


        $response[]=[
            'agentcode'=>$row['agent_id'],
            'agentname'=>$row['username'],
            'status'=>$row['status'],
            'created_at'=>$row['created_at'],
            'Type'=>(int)$row['Type'],
            'parent_id'=>$parentdata,
            'phone_no'=>$row['phone_no'],
            'uniqueid'=>$row['parent_id'],
            'id'=>$row['id']
        ];
    }

    echo json_encode($response);
}
else{
    echo "No data found";
}

$stmtagent->close();

$conn3->close();
?>