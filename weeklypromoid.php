<?php

include('Facilitator/Allfunction.php');

include('connection.php');

include('connection2.php');

include('connection3.php');




$promoid=$_GET['promoid'];


$indivisual=$_GET['indivisualValue'];


$response=[];
// $sql="SELECT DATE(activity_date) AS activity_date , COUNT(DISTINCT id) as recoun_count FROM ( SELECT id, timestamp as activity_date FROM `transaction_bank` WHERE timestamp >= NOW() - INTERVAL 7 DAY AND promo=? UNION ALL SELECT id, purchase_time as activity_date FROM `checkout` WHERE purchase_time >= NOW() - INTERVAL 7 DAY AND promo=? ) AS combined_table GROUP BY DATE(activity_date) ORDER BY activity_date";


if($indivisual==='true'){
    $promoids = [$promoid];
}
else{
    $promoids = [$promoid];


    //=======================get the child promoCode of the given if the agent the child

    $facilitatorids=getUserId($promoid,$conn3);

    // var_dump($facilitatorids);
    // exit;

    $getChidIds=getTotalChildPromoCode($conn3,$facilitatorids);

    // var_dump($getChidIds);
    // exit;

    $promoids=array_merge($promoids,$getChidIds);

    if(empty($getChidIds)){
        $promoids=[$promoid];
    }


}

$sql="SELECT DATE(FROM_UNIXTIME(timecreated)) AS activity_date,
 COUNT(u.id) AS recoun_count 
 FROM mdlwj_user u 
 JOIN mdlwj_user_info_data ind ON ind.userid=u.id 
 WHERE FROM_UNIXTIME(timecreated) >= DATE_SUB(CURDATE(),INTERVAL 7 DAY) 
 AND ind.fieldid=12 AND ind.data IS NOT NULL 
 AND ind.data IN (".implode(',',array_fill(0,count($promoids),'?',)).")
 GROUP BY DATE(FROM_UNIXTIME(timecreated))
ORDER BY activity_date";


$stmt=$conn2->prepare($sql);
$stmt->bind_param(str_repeat('s',count($promoids)),...$promoids);
$stmt->execute();


$result=$stmt->get_result();
$today= new DateTime("now");

$dailycount=[0,0,0,0,0,0,0];
$date=[];


$dailypayed=[0,0,0,0,0,0,0];
$datepayed=[];
if($result -> num_rows> 0){

    while($row=$result->fetch_assoc()){
        $date[$row['activity_date']]=$row['recoun_count'];
    }

    for( $i=0; $i<7; $i++){


        $day =clone $today;
        $day->modify("-$i day");
        $formattedDate = $day->format('Y-m-d');

        if(isset($date[$formattedDate])){


            $dailycount[$i]=$date[$formattedDate];
        }
        else{
            $dailycount[$i]=0;        }


    }

}



















    //fetch the total number  payed users in last week
    $sqlusersmdl="SELECT
    u.id as userids, ind.data as promocode
     FROM `mdlwj_user` u 
    JOIN `mdlwj_user_info_data` ind ON ind.userid=u.id
    WHERE ind.fieldid=12 AND ind.data IS NOT NULL AND ind.data IN (".implode(',',array_fill(0,count($promoids),'?')).")";
    
    $stmtusersmdl=$conn2->prepare($sqlusersmdl);
    // $stmtusersmdl->bind_param('s',$promoid);

    $stmtusersmdl->bind_param(str_repeat('s',count($promoids)),...$promoids);
    
    $stmtusersmdl->execute();
    $resultusersmdl=$stmtusersmdl->get_result();
    $userid=[];
    if($resultusersmdl ->num_rows >0){
    
        while($rowusersmdl=$resultusersmdl->fetch_assoc()){
            $userid[]=$rowusersmdl['userids'];
        }
    
    
        //====check these userids is payed or not in last week===
    
    
        if(!empty($userid)){
    
    //====LETS CONVER THE ARRAY IN TO STRING FOR IN SQL QUERY====
            $useridList=implode(",",$userid);
            
            $sqlpayed="SELECT DATE(activity_date) AS activity_date, 
            COUNT(DISTINCT id) as count_payed FROM 
            ( SELECT id, Timestamp as activity_date FROM `transaction_bank_new` WHERE Timestamp >= NOW() - INTERVAL 7 DAY AND promo IS NOT NULL AND `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND `status`=2 AND `mdl_userid` IN($useridList) 
             UNION ALL 
             SELECT id, purchase_time as activity_date FROM `checkout_new` WHERE purchase_time >= NOW() - INTERVAL 7 DAY AND promo IS NOT NULL AND `promo` NOT IN ( 'telegram','whatsapp','facebook','friends','others') AND `status`=1 AND `mdl_userid` IN($useridList) ) AS combined_table
            GROUP BY DATE(activity_date) ORDER BY activity_date";
        
        
        $stmtpayed=$conn3->prepare($sqlpayed);
        
        
        $stmtpayed->execute();
        $resultpayed=$stmtpayed->get_result();
        
        
        if($resultpayed ->num_rows >0){
        
        
        
           while($rowpayed=$resultpayed->fetch_assoc()){
        
            $datepayed[$rowpayed['activity_date']]=$rowpayed['count_payed'];
        
           }
        
           for($j=0; $j<7; $j++){
        
        $days= clone $today;
        
        $days->modify("-$j day");
        $formattedDates = $days->format('Y-m-d');
        
        if(isset($datepayed[$formattedDates])){
        
            $dailypayed[$j]=$datepayed[$formattedDates];
        }
        else{
        
            $dailypayed[$j]=0;
        }
            
           }
        }
    
        }
    
    
    
    }
    



$dailycount=array_reverse($dailycount);
$dailypayed=array_reverse($dailypayed);

echo json_encode($response=[

    'registereduser'=>$dailycount,
    'payedusers'=>$dailypayed,
]);


?>