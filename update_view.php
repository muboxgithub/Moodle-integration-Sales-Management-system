<?php

include('connection3.php');

if($_SERVER['REQUEST_METHOD']=== 'POST'){

    $messageid=$_POST['messageId'];

    $sqlupdate="UPDATE `messages` SET `view`=1 WHERE `id`=?";

    $stmtmessage=$conn33->prepare($sqlupdate);
    $stmtmessage->bind_param('i',$messageid);

    $resultmessage=$stmtmessage->execute();
    if($resultmessage=== true){
        echo "sucessfully update view";
    }
    else{
        echo "error in view update";
    }


}


?>