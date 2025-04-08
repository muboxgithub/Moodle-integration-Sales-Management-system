<?php


include('connection.php');




if($_SERVER['REQUEST_METHOD']==='POST'){

    $name = $_POST['studentName'];
$phone = $_POST['studentPhone'];
$school = $_POST['studentSchool'];
$family_phone = $_POST['studentFamily'];
$agent_code = $_POST['agentCode'];

$sqlinsert="INSERT INTO students (name,phone,school,family_phone,agent_code) VALUES (?,?,?,?,?)";


$stmt=$conn3->prepare($sqlinsert);
$stmt->bind_param('sssss', $name, $phone, $school, $family_phone, $agent_code);



$result=$stmt->execute();
if($result=== true){
        echo "Student added successfully";
}
else{
    echo "error ocurred fot adding the styudent";
}


$stmt->close();
$conn3->close();
}
?>