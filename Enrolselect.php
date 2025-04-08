<?php


include('connection.php');

include('userenrol.php');

include('connection2.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userids = $_POST['userIds'];
    $status = 2;

    $userCategory=$_POST['userCatagory'];
    $timeend=$_POST['timeEnd'];
    //the data is like   
// The selected time end for selected user is[[1,3],[1]]

    $successCount=0;
    foreach($userids as  $index=> $userid){
        



        $sqlselect="SELECT `grade`, `product_id`, `mdl_userid` FROM `transaction_bank` WHERE `id`=?";

        $stmtselect=$conn3->prepare($sqlselect);

        $stmtselect->bind_param('i',$userid);

        $stmtselect->execute();

        $resultselect=$stmtselect->get_result();

        if($resultselect->num_rows >0){


            $rowselect=$resultselect->fetch_assoc();
            //grade fetch like ["ESSLCE Exam Natural"]
            $grades=json_decode($rowselect['grade']);
            $useridss=$rowselect['mdl_userid'];

            $grade=array_map('strval',$grades);
            updateUserInfo($conn2,$grades,$useridss);

        }



        $userTimeend=$timeend[$index];


        $expireDates=[];

        foreach($userTimeend as $monthlydate){

            $expireddate=date('Y-m-d H:i:s', strtotime("+$monthlydate months"));

            $expireDates[]=$expireddate;
        }

        $userTimeendjson=json_encode($expireDates);

        $sqlupdate = "UPDATE `transaction_bank` SET `status`=?,`expiry_date`= ? WHERE `id`=?";
        $stmtstatus = $conn3->prepare($sqlupdate);

        $stmtstatus->bind_param('isi', $status,      $userTimeendjson,$userid);
        $resultstmt = $stmtstatus->execute();
    
        if ($resultstmt === true) {

            
            $successCount++; 
        } else {
            echo "error";
        }
    }

    if($successCount=== count($userids)){

        
        //  EnrolMultipleUsersInCourse($conn2,$userCategory,$grades);
        echo "success";
    

    }



    $stmtstatus->close();
    $conn3->close();
} else {
    echo "error";
}


?>
