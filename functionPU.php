<?php



include('connection.php');

/**
 * lets update the phoned int value of column in return in to 0
 * after 2 days
 */



function updatephoned($conn3){
    $startDate = new DateTime();
$startDate->sub(new DateInterval('PT24H'));
$formattedDate = $startDate->format('Y-m-d H:i:s');


    $sqlupdate="UPDATE `transaction_bank` SET `phoned`=0 WHERE phone_date <=? AND phoned=1";

    $stmtupdate=$conn3->prepare($sqlupdate);

    $stmtupdate->bind_param('s', $formattedDate);

  $stmtupdate->execute();

//   if($stmtupdate->affected_rows>0){
//     echo "Phoned value updated successfully";
//   }
//   else{
//     echo "No phoned value updated";
//   }





}

//functio for updateing the checkout table
function updatecheckout($conn3){

    $startDate=new DateTime();
    $startDate->sub(new DateInterval('PT24H'));
    $formattedDate=$startDate->format('Y-m-d H:i:s');
   // $date=date('Y-m-d H:i:s', strtotime('-2 days'));


    $sqlcheckout="UPDATE `checkout` SET `phoned`=0 WHERE `phone_date`<=? AND `phoned`=1";
    $stmtcheckout=$conn3->prepare($sqlcheckout);
    $stmtcheckout->bind_param('s', $formattedDate);

    $stmtcheckout->execute();

}




?>