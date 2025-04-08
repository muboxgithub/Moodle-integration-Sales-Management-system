<?php
include('connection.php');

include('userenrol.php');

include('connection2.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userId'];
    $status = $_POST['Status'];

    $moodleid=$_POST['moodleId'];

    // $catagoryids=$_POST['catagoryId'];

    $timeend=$_POST['timeEnd'];
    //it is like[1,2]


    $response=[];
    //lets create time end array
   

    $expiredatates=[];


    foreach($timeend as $monthsToAdd){

        $expiredate=date('Y-m-d H:i:s', strtotime("+$monthsToAdd months"));
        $expiredatates[]=$expiredate;
    }
    $expiredatejson=json_encode($expiredatates);
    
    $sqlupdate = "UPDATE `transaction_bank` SET `status`=? ,`expiry_date`= ? WHERE `id`=?";
    $stmtstatus = $conn3->prepare($sqlupdate);


    
    $stmtstatus->bind_param('isi', $status,$expiredatejson, $userid);
    $resultstmt = $stmtstatus->execute();

    if ($resultstmt === true) {


        $sqlselect="SELECT `grade`, `product_id` FROM `transaction_bank` WHERE `id`=?";

        $stmtselect=$conn3->prepare($sqlselect);

        $stmtselect->bind_param('i',$userid);

        $stmtselect->execute();

        $resultselect=$stmtselect->get_result();

        if($resultselect->num_rows >0){


            $rowselect=$resultselect->fetch_assoc();
            //grade fetch like ["ESSLCE Exam Natural"]
            $grades=json_decode($rowselect['grade']);

            $grade=array_map('strval',$grades);



            $catagoryids=json_decode($rowselect['product_id']);

          
          
            $intcategoryids=array_map('intval',$catagoryids);
            //$catagoryids return ["1","2"]
        }


       
        if($status== 2){
            //  enrollUserInCourses($conn2,$moodleid,$intcategoryids,$timeend);
          
            updateUserInfo($conn2,$grades,$moodleid);


 
            echo "success";
            // echo json_encode($intcategoryids);
            exit;
        }
        else if($status== 1){
            
            $sqlupdatess = "UPDATE `transaction_bank` SET `expiry_date`= NULL WHERE `id`=?";
            $stmtupdatess=$conn3->prepare($sqlupdatess);
            $stmtupdatess->bind_param('i',$userid);

            $resultstmtupdatesss=$stmtupdatess->execute();

            if(  $resultstmtupdatesss=== true){
                    // deleteUserEnrollmentsAndRoles($conn2,$moodleid);
                    echo "success";
                    exit;

            }
         
        }
      


    } else {
        $response[]=array(
            'message'=>'err in updating transaction table',
        );
    }

    $stmtstatus->close();
    $conn3->close();
    $conn2->close();
} else {
    $response[]=array(
        'message'=>'errror ocurred full',
    );
}
header('Content-Type: application/json');
echo json_encode($response);
?>
