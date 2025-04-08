<?php
// Include required connection files
include('connection.php');
include('connection2.php');
include('connection3.php');
include('Facilitator/Allfunction.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totaccepted = 0;

    // Check if promoid is provided
    if (isset($_POST['promoid'])) {
        $promoid = $_POST['promoid'];
        $isindivisual=$_POST['indivisualValue'];

        if($isindivisual=='true'){
            $promoids=[$promoid];

        }
        else{
            $promoids=[$promoid];

              //====get the child promocode of the given promocode if the agent has child

              $facilitatorids=getUserId($promoid,$conn3);
            //   var_dump($facilitatorids);
            //   exit;

              $getChildIds=getTotalChildPromoCode($conn3,$facilitatorids);


            //   var_dump($getChildIds);
            //   exit;
              $promoids=array_merge($promoids,$getChildIds);
      
      
              if(empty($getChildIds)){
                  $promoids=[$promoid];
              }
        }

        // Fetch users with the given promo code
        $sql = "SELECT u.id AS userid
                FROM mdlwj_user u
                JOIN mdlwj_user_info_data ind ON ind.userid = u.id
                WHERE ind.fieldid = 12 AND ind.data IS NOT NULL AND ind.data  IN (".implode(',',array_fill(0,count($promoids),'?',)).")";
        $stmt = $conn2->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(str_repeat('s',count($promoids)),...$promoids);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $userIds = [];
                while ($row = $result->fetch_assoc()) {
                    $userIds[] = $row['userid'];
                }

                if (!empty($userIds)) {
                    $userIdList = implode(",", $userIds);

                    // Fetch payment records for these users
                    $sqlPayed = "SELECT COUNT(DISTINCT id) AS count_payed
                                 FROM (
                                     SELECT id FROM transaction_bank_new 
                                     WHERE promo IS NOT NULL AND promo != 'Null'
                                     AND promo NOT IN ('telegram', 'whatsapp', 'facebook', 'friends', 'others')
                                     AND `status` = 2 AND mdl_userid IN ($userIdList)
                                     UNION ALL
                                     SELECT id FROM checkout_new 
                                     WHERE promo IS NOT NULL AND promo != 'Null'
                                     AND promo NOT IN ('telegram', 'whatsapp', 'facebook', 'friends', 'others')
                                     AND `status` = 1 AND mdl_userid IN ($userIdList)
                                 ) AS combined_table";
                    $stmtPayed = $conn3->prepare($sqlPayed);
                    $stmtPayed->execute();
                    $resultPayed = $stmtPayed->get_result();

                    if ($resultPayed && $resultPayed->num_rows > 0) {
                        $rowPayed = $resultPayed->fetch_assoc();
                        echo $rowPayed['count_payed'];
                    } else {
                        echo "0";
                    }
                } else {
                    echo "0";
                }
            } else {
                echo "0";
            }
        } else {
            echo "0";
        }
    } else {
        // Fetch all users with valid promo codes
        $sql = "SELECT u.id AS userid
                FROM mdlwj_user u
                JOIN mdlwj_user_info_data ind ON ind.userid = u.id
                WHERE ind.fieldid = 12 AND ind.data IS NOT NULL AND ind.data != '' AND ind.data != 'Null'";
        $stmt = $conn2->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $userIds = [];
                while ($row = $result->fetch_assoc()) {
                    $userIds[] = $row['userid'];
                }

                if (!empty($userIds)) {
                    $userIdList = implode(",", $userIds);

                    // Fetch payment records for these users
                    $sqlPayed = "SELECT COUNT(DISTINCT id) AS count_payed
                                 FROM (
                                     SELECT id FROM transaction_bank_new 
                                     WHERE promo IS NOT NULL AND promo != 'Null'
                                     AND promo NOT IN ('telegram', 'whatsapp', 'facebook', 'friends', 'others')
                                     AND `status` = 2 AND mdl_userid IN ($userIdList)
                                     UNION ALL
                                     SELECT id FROM checkout_new 
                                     WHERE promo IS NOT NULL AND promo != 'Null'
                                     AND promo NOT IN ('telegram', 'whatsapp', 'facebook', 'friends', 'others')
                                     AND status = 1 AND mdl_userid IN ($userIdList)
                                 ) AS combined_table";
                    $stmtPayed = $conn3->prepare($sqlPayed);
                    $stmtPayed->execute();
                    $resultPayed = $stmtPayed->get_result();

                    if ($resultPayed && $resultPayed->num_rows > 0) {
                        $rowPayed = $resultPayed->fetch_assoc();
                        echo $rowPayed['count_payed'];
                    } else {
                        echo "0";
                    }
                } else {
                    echo "0";
                }
            } else {
                echo "0";
            }
        } else {
            echo "0";
        }
    }
}
?>
