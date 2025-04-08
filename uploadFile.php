<?php

include('connection3.php');



if($_SERVER['REQUEST_METHOD']==='POST' && isset($_FILES['file'])){



    $uplaodfile=$_FILES['file']['name'];

    $temp_name=$_FILES['file']['tmp_name'];


    $uploaddir='upload/';

    $uplaodpath=$uploaddir . $uplaodfile;

    if(move_uploaded_file($temp_name,$uplaodpath)){

        


   $role=0;
   $senderid=0;
   $reciverid=$_POST['reciverId'];
$sqlquery="INSERT INTO `messages` (`role`,`senderid`,`recevierid`,`attachment_url`) VALUES (?,?,?,?)";


$stmt=$conn33->prepare($sqlquery);

$stmt->bind_param('iiis',$role,$senderid,$reciverid,$uplaodfile);


$resultstmt=$stmt->execute();



if($resultstmt=== true){

 echo "success";
 exit;

}
else{
    echo "error";
    exit;
}
    }
    else{

        echo "error ocurred in uploading";
        exit;
    }




}
else{
    echo "no file uplaoded";
    exit;
}


?>