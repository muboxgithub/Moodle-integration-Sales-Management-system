<?php
include('connection.php');
include('connection2.php');
include('connection3.php');
include('Facilitator/Allfunction.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $promoid = $_POST['promoid'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];




    // $facilitatorCode=$_POST['FacilitatorCode'];


    // //============check if the facilitator code is valid or not=======

    // if(!empty($facilitatorCode)){

    //     $promoids=[$facilitatorCode];
    //     $facilitatorids=getUserId($facilitatorCode,$conn3);

    //     $getChidIds=getTotalChildPromoCode($conn3,$facilitatorids);

    //     $promoids=array_merge($promoids,$getChidIds);


    //     if(empty($promoids)){
    //         $promoids=[$facilitatorCode];
    //     }

    // }

    // Convert the date strings to the correct format for SQL query
    $startDateFormatted = date('Y-m-d H:i:s', strtotime($startDate));
    $endDateFormatted = date('Y-m-d H:i:s', strtotime($endDate));
    $startDateFormatteUnix = strtotime($startDate);
    $endDateFormattedUnix = strtotime($endDate);

    // Initialize response array with default values
    $response = [
        'totalregisterpromocodeuser' => 0,
        'totalenteruser' => 0,
        'totalpayedusers' => 0,
    ];

    // Query to find total registered promo code users
    $sqltotalregister = "SELECT COUNT(u.id) AS totalregisterpromo FROM `mdlwj_user` u
    JOIN `mdlwj_user_info_data` ind ON ind.userid = u.id
    WHERE ind.fieldid = 12 AND ind.data IS NOT NULL AND ind.data = ?";
    $stmttotalregister = $conn2->prepare($sqltotalregister);
    $stmttotalregister->bind_param("s", $promoid);
    $stmttotalregister->execute();
    $resulttotalregister = $stmttotalregister->get_result();

    if ($resulttotalregister->num_rows > 0) {
        $rowtotalregister = $resulttotalregister->fetch_assoc();
        $response['totalregisterpromocodeuser'] = $rowtotalregister['totalregisterpromo'];
    }

    // Query to find total users who entered the promo code within the given time
    $sqlfindRegister = "SELECT COUNT(u.id) AS totenterpromocodeuser FROM `mdlwj_user` u
    JOIN `mdlwj_user_info_data` ind ON ind.userid = u.id
    WHERE ind.fieldid = 12 AND ind.data IS NOT NULL AND ind.data = ? AND `timecreated` BETWEEN ? AND ?";
    $stmtRegister = $conn2->prepare($sqlfindRegister);
    $stmtRegister->bind_param("sii", $promoid, $startDateFormatteUnix, $endDateFormattedUnix);
    $stmtRegister->execute();
    $resultRegister = $stmtRegister->get_result();

    if ($resultRegister->num_rows > 0) {
        $rowRegister = $resultRegister->fetch_assoc();
        $response['totalenteruser'] = $rowRegister['totenterpromocodeuser'];
    }

    // Query to find total payed users
    $sqltotalmdl = "SELECT u.id as userids FROM `mdlwj_user` u 
    JOIN `mdlwj_user_info_data` ind ON ind.userid = u.id
    WHERE ind.fieldid = 12 AND ind.data = ?";
    $stmttotalmdl = $conn2->prepare($sqltotalmdl);
    $stmttotalmdl->bind_param("s", $promoid);
    $stmttotalmdl->execute();
    $resulttotalmdl = $stmttotalmdl->get_result();

    $userids = [];
    while ($rowtotalmdl = $resulttotalmdl->fetch_assoc()) {
        $userids[] = $rowtotalmdl['userids'];
    }

    if (!empty($userids)) {
        $userids_str = implode(",", $userids);
        $sqlpayed = "SELECT COUNT(*) as totalpayedpromo FROM (
            SELECT id FROM `transaction_bank_new` WHERE `Timestamp` BETWEEN ? AND ? AND status = 2 AND `mdl_userid` IN ($userids_str)
            UNION ALL 
            SELECT id FROM checkout_new WHERE `promo` NOT IN ('telegram','whatsApp','facebook','friends','others') AND `purchase_time` BETWEEN ? AND ? AND status = 1 AND `mdl_userid` IN ($userids_str)
        ) AS combined_tables";

        $stmtpayed = $conn3->prepare($sqlpayed);
        $stmtpayed->bind_param("ssss", $startDateFormatted, $endDateFormatted, $startDateFormatted, $endDateFormatted);
        $stmtpayed->execute();
        $resultpayed = $stmtpayed->get_result();

        if ($resultpayed->num_rows > 0) {
            $rowpayed = $resultpayed->fetch_assoc();
            $response['totalpayedusers'] = $rowpayed['totalpayedpromo'];
        }
    }

    // Output the response as JSON
    echo json_encode($response);
    exit;
}
?>
