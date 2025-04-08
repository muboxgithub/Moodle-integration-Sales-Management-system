<?php



include('connection.php');



if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $phone=$_POST['Phone'];
$sqlcheck="SELECT * FROM `students` WHERE `phone`=?";


$stmtcheck=$conn3->prepare($sqlcheck);

$stmtcheck->bind_param("s",$phone);

$stmtcheck->execute();

$result=$stmtcheck->get_result();
if($result->num_rows>0){
    echo "true";
    exit;
}
else{
    echo "false";
    exit;
}




}








?>