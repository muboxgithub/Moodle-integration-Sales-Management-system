<?php

include('connection.php');

include('connection2.php');

include('connection3.php');


header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD']==='POST'){


    $sqlfacilitato="SELECT * FROM agent WHERE parent_id=0 ORDER BY `agent_id` ASC";

    $stmtfacilitator=$conn3->prepare($sqlfacilitato);

    $stmtfacilitator->execute();
    $resultfacilitator=$stmtfacilitator->get_result();
    $response=[];
    if($resultfacilitator->num_rows>0){


        while($rowfacilitator=$resultfacilitator->fetch_assoc()){
            $response[]=$rowfacilitator['agent_id'];
        }
        echo json_encode($response);
    }
    else{
        echo json_encode($response=['error'=>'there is no facilitator']);
    }




}
else{


    $response=[
        'status'=>'invalid request',
    ];
    echo json_encode($response);
    exit;

}






?>