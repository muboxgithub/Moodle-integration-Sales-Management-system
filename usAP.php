<?php

include('connection.php');
include('connection2.php');
header('Content-Type: application/json');

$promoid = 'BTE-001';
$response = array();

$sqlapplied = "SELECT `mdl_userid` FROM (SELECT `mdl_userid` FROM `transaction_bank` WHERE promo=? AND status=1 
              UNION ALL SELECT `mdl_userid` FROM checkout WHERE promo=? AND status=0) AS combined_tables";

$stmtunpayed = $conn3->prepare($sqlapplied);
$stmtunpayed->bind_param('ss', $promoid, $promoid);
$stmtunpayed->execute();
$resultunpayed = $stmtunpayed->get_result();

if ($resultunpayed->num_rows > 0) {
    while ($rowunpayed = $resultunpayed->fetch_assoc()) {
        $userid = $rowunpayed['mdl_userid'];

        $sqlmlduser = "SELECT * FROM `mdl_user` WHERE `id`=?";
        $stmtuser = $conn2->prepare($sqlmlduser);
        $stmtuser->bind_param('i', $userid);
        $stmtuser->execute();
        $resultuser = $stmtuser->get_result();

        if ($resultuser->num_rows > 0) {
            $rowuser = $resultuser->fetch_assoc();
            $username = $rowuser['username'];
            $email = $rowuser['email'];
            $phone = $rowuser['phone1'];

            while($rowuser=$resultuser->fetch_assoc()){
                $response[] = [
                    'username'=> $username,
                    'email'=> $email,
                    'phone'=> $phone
                ];
                var_dump($username);
            }
            // Check if user data already exists in response array before adding
          
        }
    }

   
}

// // Output the response array for debugging
// echo json_encode($response);

?>