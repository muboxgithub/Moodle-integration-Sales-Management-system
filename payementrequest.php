<?php

include('connection.php');

include('connection2.php');

include('connection3.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Uncomment or define $promoid as needed
    // $promoid = $_POST['promoid'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Validate date format
    if (!$startDate || !$endDate) {
        echo json_encode(['error' => 'Invalid date input.']);
        exit;
    }
    $response = [
        'totalregisterpromocodeuser'=>0,
        'totalenteruser' => 0,
        'totalpayedusers' => 0,
        'monthlysubscriber' => 0,
        'thiredmonthlysubscriber'=>0,
        'Sixmonthlysubscriber'=>0,

    ];

    // Convert the date strings to the correct format for SQL query
    $startDateFormatted = date('Y-m-d H:i:s', strtotime($startDate));
    $endDateFormatted = date('Y-m-d H:i:s', strtotime($endDate));
    $startDateFormatteUNix=strtotime($startDate);

    $endDateFormattedUnix=strtotime($endDate);

    $sqltotalregister="SELECT COUNT(u.id) AS totalregisterpromo, u.username, ind.data FROM `mdlwj_user` u
    JOIN `mdlwj_user_info_data` ind 	ON ind.userid=u.id
    
    WHERE ind.fieldid=12 AND ind.data IS NOT NULL AND ind.data != ''";
    
    $stmttotalregister=$conn2->prepare($sqltotalregister);

    $stmttotalregister->execute();
    
    $resulttotalregister=$stmttotalregister->get_result();
    
    if($resulttotalregister->num_rows>0){
    
        $rowtotalregister=$resulttotalregister->fetch_assoc();
        $response['totalregisterpromocodeuser']= $rowtotalregister['totalregisterpromo'];
           



        $sqlfindRegister="SELECT COUNT(u.id) AS totenterpromocodeuser, u.username, ind.data FROM `mdlwj_user` u
JOIN `mdlwj_user_info_data` ind 	ON ind.userid=u.id

WHERE ind.fieldid=12 AND ind.data IS NOT NULL AND  ind.data != '' AND `timecreated` BETWEEN ? AND ?";

$stmtRegister=$conn2->prepare($sqlfindRegister);
$stmtRegister->bind_param("ii",  $startDateFormatteUNix, $endDateFormattedUnix);

$stmtRegister->execute();

$resultRegister=$stmtRegister->get_result();

if($resultRegister->num_rows>0){

    $rowRegister=$resultRegister->fetch_assoc();
    $response['totalenteruser']=$rowRegister['totenterpromocodeuser'];







// Calculate the total number of users who paid
//=====lets get the total number of payed users======


$sqltotalmdl="SELECT
u.id as userids, ind.data as promocode
 FROM `mdlwj_user` u 
JOIN `mdlwj_user_info_data` ind ON ind.userid=u.id
WHERE ind.fieldid=12 AND ind.data IS NOT NULL AND ind.data != ''";

$stmttotalmdl=$conn2->prepare($sqltotalmdl);

$stmttotalmdl->execute();

$resulttotalmdl=$stmttotalmdl->get_result();


$userids=[];
if($resulttotalmdl->num_rows>0){

   while($rowtotalmdl=$resulttotalmdl->fetch_assoc()){
    $userids[]=$rowtotalmdl['userids'];

   }
  


    //======lets check thes usersid is payed in a given time period=======

    if(!empty($userids)){

        //====lets convert the array in to string for sql query====
        $userids_str=implode(",",$userids);

        $sqlpayed="SELECT COUNT(*) as totalpayedpromo FROM( SELECT id FROM `transaction_bank_new` WHERE   `Timestamp` BETWEEN ? AND ?  AND status=2 AND `mdl_userid` IN ($userids_str)
         UNION ALL SELECT id FROM checkout_new WHERE  `promo` NOT IN ( 'telegram','whatsApp','facebook','friends','others') AND `purchase_time` BETWEEN ? AND ? AND status=1 AND `mdl_userid` IN ($userids_str) ) AS combined_tables";




$stmtpayed=$conn3->prepare($sqlpayed);
$stmtpayed->bind_param("ssss", $startDateFormatted, $endDateFormatted,$startDateFormatted, $endDateFormatted);

$stmtpayed->execute();

$resultpayed=$stmtpayed->get_result();

if($resultpayed->num_rows>0){
    $rowpayed=$resultpayed->fetch_assoc();

    $response['totalpayedusers']=$rowpayed['totalpayedpromo'];  




    
}
    }





    }

$duration = '[1]';
$duration2 = '["1"]';

$sqlgrade9 = "SELECT COUNT(*) as totalpayedmonthly FROM ( SELECT id FROM `transaction_bank_new` WHERE `promo` IS NOT NULL AND `promo` NOT IN ('telegram', 'whatsapp', 'facebook', 'friends', 'others') AND `Timestamp` BETWEEN ? AND ? AND status = 2 AND `duration` IN (?, ?) UNION ALL SELECT id FROM checkout_new WHERE `promo` IS NOT NULL AND `promo` NOT IN ('telegram', 'whatsapp', 'facebook', 'friends', 'others') AND `purchase_time` BETWEEN ? AND ? AND status = 1 AND `duration` IN (?, ?) ) AS combined_tables";

$stmtgrade = $conn3->prepare($sqlgrade9);

$stmtgrade->bind_param('ssssssss', $startDateFormatted,$endDateFormatted,$duration, $duration2,$startDateFormatted,$endDateFormatted, $duration, $duration2);
$stmtgrade->execute();

$resultgrade = $stmtgrade->get_result();

if ($resultgrade->num_rows > 0) {
    $rowgrade = $resultgrade->fetch_assoc();
    $response['monthlysubscriber'] = $rowgrade['totalpayedmonthly'];
}



//--=--====== code for 3 mothly subscriber ======--=--=


$duration22='[3]';

$sql3monthly="SELECT COUNT(*) as totalpayed3month FROM( SELECT id FROM `transaction_bank_new` WHERE `promo` IS NOT NULL AND `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND `Timestamp` BETWEEN ? AND ? AND status=2 AND `duration`=? UNION ALL SELECT id FROM checkout_new WHERE `promo` IS NOT NULL AND `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND `purchase_time` BETWEEN ? AND ? AND status=1 AND `duration`=? ) AS combined_tables";

$stmt3monthly=$conn3->prepare($sql3monthly);

$stmt3monthly->bind_param('ssssss', $startDateFormatted,$endDateFormatted,$duration22,$startDateFormatted,$endDateFormatted, $duration22);
$stmt3monthly->execute();


$resultgrade3monthly=$stmt3monthly->get_result();


if($resultgrade3monthly->num_rows>0){

$row3monthly=$resultgrade3monthly->fetch_assoc();
$response['thiredmonthlysubscriber'] = $row3monthly['totalpayed3month'];

}


//====code for 6 monthly subscriber====


$duration3='[6]';

$sql6monthly="SELECT COUNT(*) as totalpayed6monthly FROM( SELECT id FROM `transaction_bank_new` WHERE `promo` IS NOT NULL AND `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND `Timestamp` BETWEEN ? AND ?  AND status=2 AND `duration`=? UNION ALL SELECT id FROM checkout_new WHERE `promo` IS NOT NULL AND `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND `purchase_time` BETWEEN ? AND ? AND status=1 AND `duration`=? ) AS combined_tables";

$stmt6monthly=$conn3->prepare($sql6monthly);

$stmt6monthly->bind_param('ssssss', $startDateFormatted,$endDateFormatted,$duration3,$startDateFormatted,$endDateFormatted, $duration3);
$stmt6monthly->execute();


$result6monthly=$stmt6monthly->get_result();


if($result6monthly->num_rows>0){

$row6monthly=$result6monthly->fetch_assoc();


$response['Sixmonthlysubscriber'] = $row6monthly['totalpayed6monthly'];
}

echo json_encode($response);
exit;
} else {
echo json_encode(['error' => 'No records found.']);
exit;
}

    }



  
    $stmttotalregister->close();
$stmtRegister->close();// Move this line inside the conditional block

}
?>