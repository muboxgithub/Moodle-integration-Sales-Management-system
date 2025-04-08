<?php

include('connection.php');



if($_SERVER['REQUEST_METHOD']=== 'POST'){

    $username=$_POST['username'];


    $password=$_POST['password'];



    function validate($data){

        $data=trim($data);
        $data=stripslashes($data);

        $data=htmlspecialchars($data);
        return $data;
    }

    $agentname=validate($username);
    $agentpassowrd=validate($password);


    $sqlfetch="SELECT * FROM `agent` WHERE `agent_id`=?";

    $stmt=$conn3->prepare($sqlfetch);

    $stmt->bind_param('s',$agentname);

    $stmt->execute();

    $result=$stmt->get_result();
if($result->num_rows==1){


$row=$result->fetch_assoc();

$previous_password=$row['password'];
if(md5($agentpassowrd)=== $previous_password){



    if($row['status']==1){
        session_start();

        $_SESSION['agentcode']=$agentname;
        $_SESSION['username']=$row['username'];
        $_SESSION['Type']=$row['Type'];
        // header("Location: index.php");
    
        if($row['Type']==0){
            echo "Facilitator login successfully";
        }
        else{
            echo "salles agent login successfully";
        }

    }
    else{
        echo "Your account is inactive or suspended";
    }

  


}
else{

   
    echo "Invalid password";
}
}
else{
 
    
    echo "Invalid username or password";
}





}



?>