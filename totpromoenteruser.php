<?php




include('connection.php');

include('connection2.php');

include('connection3.php');

include('Facilitator/Allfunction.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

       
        // Using prepared statement to prevent SQL injection
        $sqlapplied = "SELECT COUNT(u.id) AS totenterpromocodeuser, u.username, ind.data FROM `mdlwj_user` u
JOIN `mdlwj_user_info_data` ind 	ON ind.userid=u.id

WHERE ind.fieldid=12 AND ind.data IS NOT NULL AND ind.data  IN (".implode(',',array_fill(0,count($promoids),'?',)).")";
        
        $stmt = $conn2->prepare($sqlapplied);
        $stmt->bind_param(str_repeat('s',count($promoids)),...$promoids ); // Assuming promo is a string, adjust if necessary
        $stmt->execute();
        $resultstmt = $stmt->get_result();

        if ($resultstmt->num_rows > 0) {
            $row = $resultstmt->fetch_assoc();
            $totaccepted = $row['totenterpromocodeuser'];
            echo $totaccepted;
        } else {
            echo "Error occurred while fetching the number of accepted";
        }
    } else {
        // Handle the case when promoid is not set
        $sqlapplied="SELECT COUNT(u.id) AS totenterpromocodeuser, u.username, ind.data FROM `mdlwj_user` u
JOIN `mdlwj_user_info_data` ind 	ON ind.userid=u.id

WHERE ind.fieldid=12 AND ind.data IS NOT NULL AND ind.data != '' AND ind.data != 'Null'";
        $stmt=$conn2->prepare($sqlapplied);
        $stmt->execute();
        $resultstmt=$stmt->get_result();
        
        if($resultstmt->num_rows >0){
            $row=$resultstmt->fetch_assoc();
            $totaccepted=$row['totenterpromocodeuser'];
            echo "$totaccepted";
        }
        else{
            echo "error ocurred for fetching the number of accepted";
        }
    }
}

?>