<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['agentid'];
    $agentType = $_POST['agentType'];
    $selectedOption = $_POST['parentStatusSelectedd'];
    $agentpromocode = $_POST['agentpromocode'];
    $agentname = $_POST['agentname'];
    $phone = $_POST['phone'];
    $currentParent = $_POST['currentParent'];
    $password = $_POST['password'];
    $encrypedpassword = md5($password);

    $parentid = 0;

    if ($agentType == 1) {

        //========check if the sallesa gent may be facilitator before so rest his childrent 
        // resetParent($conn3, $id);
        if ($currentParent == 0) {
            $parentid = $selectedOption;
        } else if($selectedOption != '') {
            $parentid = $selectedOption;
        }
        else{
            $parentid = $currentParent;
        }
    }

    if ($password !== '') {
        $sqlupdateagent = "UPDATE `agent` SET `agent_id`=?, `username`=?, `phone_no`=?, `password`=?, `parent_id`=?, `Type`=? WHERE `id`=?";
        $stmtupdateagent = $conn3->prepare($sqlupdateagent);
        $stmtupdateagent->bind_param("ssssiii", $agentpromocode, $agentname, $phone, $encrypedpassword, $parentid, $agentType, $id);
    } else {
        $sqlupdateagent = "UPDATE `agent` SET `agent_id`=?, `username`=?, `phone_no`=?, `Type`=?, `parent_id`=? WHERE `id`=?";
        $stmtupdateagent = $conn3->prepare($sqlupdateagent);
        $stmtupdateagent->bind_param("sssiii", $agentpromocode, $agentname, $phone, $agentType, $parentid, $id);
    }

    $resultstmt = $stmtupdateagent->execute();

    if ($resultstmt) {
        echo "Agent updated successfully";
    } else {
        echo "Error updating the agent";
    }
}




function resetParent($conn3, $id){


    $sqlresetparent="UPDATE `agent` SET `parent_id`=0 WHERE `parent_id`=?";
    $stmtresetparent=$conn3->prepare($sqlresetparent);
    $stmtresetparent->bind_param("i",$id);

   
   $stmtresetparent->execute();;

}
?>