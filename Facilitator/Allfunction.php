<?php


// include('../connection.php');
// include('../connection2.php');

/**
 * belowe function i used to get the user id based on promocode
 * @param agentCode
 * @param conn3
 */

function getUserId($agentcode,$conn3){




  try{
    $sqlfetch="SELECT * FROM `agent` WHERE `agent_id`=?";
    $stmt=$conn3->prepare($sqlfetch);

    $stmt->bind_param('s',$agentcode);

    $stmt->execute();
    $result=$stmt->get_result();
if($result->num_rows == 1){

    $row=$result->fetch_assoc();
    return $row['id'];
}
else{
    return 0;
}

  }catch(Exception $e){

    return ['error'=>$e->getMessage()];

  }
}

/**
 * belowe code is used to return the type of the user 
 * @param promoCode
 * @param conn3
 */

 function getUserType($conn3,$promoCode){
 

    try{
        $sqlfetch="SELECT * FROM `agent` WHERE `agent_id`=?";
        $stmt=$conn3->prepare($sqlfetch);
    
        $stmt->bind_param('s',$promoCode);
    
        $stmt->execute();
        $result=$stmt->get_result();
    if($result->num_rows == 1){
    
        $row=$result->fetch_assoc();
        return $row['Type'];
    }
    else{
        return '';
    }

    }catch(Exception $e){
        return['error'=>$e->getMessage()];

    }

 }


 /**
  * get the toal child found in the facilitator id
    * @param facilitatorId
    * @param conn3
 */



 function getTotalChildPromoCode($conn3,$facilitatorid){


   try{
    $response=[];
    $sqltotalchild="SELECT agent_id FROM `agent` WHERE `parent_id`=?";

    $stmttotalchild=$conn3->prepare($sqltotalchild);
    $stmttotalchild->bind_param('i',$facilitatorid);
    $stmttotalchild->execute();
    $resulttotalchild=$stmttotalchild->get_result();

    if($resulttotalchild->num_rows >0){

    while($rowtotalchild=$resulttotalchild->fetch_assoc()){
        $response[]=$rowtotalchild['agent_id'];

    }
    return $response;
    }
    else{
        return [];

    }
   }catch(Exception $e){
    return ['error'=> $e->getMessage()];
   }
 }
?>