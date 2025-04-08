<?php

include('connection3.php');
if($_SERVER['REQUEST_METHOD']=='POST'){


    $userid=$_POST['deletedId'];

    $sqldeletemessage="DELETE FROM `messages` WHERE `id`=?";

    $stmt=$conn33->prepare($sqldeletemessage);

    $stmt->bind_param('i',$userid);
    $result=$stmt->execute();

    if($result=== true){
        echo "success";
        exit;
    }
    else{
        echo "error";
        exit;
    }
}


?>