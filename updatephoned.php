<?php


include('connection.php');



if($_SERVER['REQUEST_METHOD']==='POST'){



    $tbid = $_POST['tbId'];

    $tcid=$_POST['tcId'];

    $checkvalue = $_POST['checkValue'];


$date=date('Y-m-d H:i:s');

//lets get the time with date fromat
    if($tbid != ''){

        $sqltb="UPDATE `transaction_bank_new` SET `phoned`=? ,`phone_date`=? WHERE `id`=?";

        $stmttb=$conn3->prepare($sqltb);
        $stmttb->bind_param("isi",$checkvalue,$date,$tbid);
       
        $resulttb= $stmttb->execute();


        if($resulttb=== true){
            echo "success in updating the transaction_bank table";
        }
        else{
            echo "error in updating the transaction_bank table";
        }
    }
    else if($tcid != ''){


        $sqltcid="UPDATE `checkout` SET `phoned`=? ,`phone_date`=? WHERE `id`=?";
        $stmttcid=$conn3->prepare($sqltcid);
        $stmttcid->bind_param("isi",$checkvalue,$date,$tcid);
        $resulttcid= $stmttcid->execute();
        if($resulttcid=== true){
            echo "success updted the checkout table";
        }
        else{
            echo "error in updating the checkout table";
        }
    }
}


?>