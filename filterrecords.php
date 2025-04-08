<?php

include('connect.php');


$start_time=strtotime('April 1');


//get unix time stamp
$end_oftime=strtotime('May 1');



$sqlquery="SELECT COUNT(id) AS number_student FROM `user_enrolments` WHERE `timecreated`>=? AND `timecreated`<?";





$stmt=$conn2->prepare($sqlquery);

$stmt->bind_param('ii',$start_time,$end_oftime);

$stmt->execute();

$result=$stmt->get_result();


if($result->num_rows>0){

    while($row=$result->fetch_assoc()){
        echo "numer of students enrolled in the system: ".$row['number_student'];
    }
}
else{
    echo "no records found";
}






?>