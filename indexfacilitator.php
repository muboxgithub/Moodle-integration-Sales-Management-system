<?php



include('connection.php');
include('connection2.php');
include('functionclass.php');

// include('connection3.php');

include('functionPU.php');
// require_once(__DIR__ . '/../../config.php');


// Get the session ID




// if(isloggedin() && !isguestuser()){

//     global $USER, $DB;



// // Check if the user is an admin
// // $is_admin = is_siteadmin($USER->id);

// // // Check if the user is a manager (assuming role ID for manager is 1)
// // $is_manager = user_has_role_assignment($USER->id, 1);

// // // Check if the user is a teacher (assuming role ID for teacher is 3)
// // $is_teacher = user_has_role_assignment($USER->id, 3);

// // // Check if the user is a student (assuming role ID for student is 5)
// // $is_student = user_has_role_assignment($USER->id, 5);

// // // If the user is an admin, manager, or teacher, don't treat them as a student
// // if ($is_admin || $is_manager || $is_teacher) {
// //     $is_student = false;
// // }


//     if (!$is_studnet) {

//      // Query the mdl_session table to check if the session ID exists
  


//     //DelateusersafterTime($conn3);
//     $sqlquery = "SELECT * FROM `transaction_bank` ORDER BY `timestamp` ASC ";
//     $stmt = $conn3->prepare($sqlquery);
//     $stmt->execute();
//     $resultstmt = $stmt->get_result();

//     } else {
//         // Redirect students or unauthorized users to an error or login page
//         
//     <html>
//         <head>
//             <title>Error page</title>
//         </head>
//         <body>
//         </body>
//         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
//         <script type="text/javascript">
//             Swal.fire({
//                 title: 'Error',
//                 text: 'You are not authorized to access this page',
//                 icon: 'error',
//                   width:"400px",
//                   height:"70px",
//                   showConfirmButton: true,
//                   showCancelButton:false,
               
//                 confirmButtonColor: "#3085d6",
//   cancelButtonColor: "#d33",
//   confirmButtonText: "Yes"
// }).then((result)=>{
//    if(result.isConfirmed){
//     window.location.href='http://etemari.net/my';
//    }
//                // 3 seconds
//             });
//         </script>
//     </html>
//     <?php
//     exit;
//     }



    
// } else {
//     // Session ID not provided in the Moodle config file, show an error message
//     
//     <html>
//         <head>
//             <title>Error page</title>
//         </head>
//         <body>
//         </body>
//         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
//         <script type="text/javascript">
//             Swal.fire({
//                 title: 'Error',
//                 text: 'Session ID not provided. Access denied. Do you want to login',
//                 icon: 'error',
//                   width:"400px",
//                   height:"70px",
//                   showConfirmButton: true,
//                   showCancelButton:true,
               
//                 confirmButtonColor: "#3085d6",
//   cancelButtonColor: "#d33",
//   confirmButtonText: "Yes"
// }).then((result)=>{
//    if(result.isConfirmed){
//     window.location.href='http://localhost/server/moodle/login/index.php';
//    }
//                // 3 seconds
//             });
//         </script>
//     </html>
//     <?php
//     exit;
// }

session_start();


  
if(!(isset($_SESSION['agentcode']) && isset($_SESSION['username'])))
{

header("Location: http://localhost/server/moodle/local/Dashbord%20sells%20agents/login.php");

}
else{
    

   
// ?>


<?php

updatephoned($conn3);

updatecheckout($conn3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
   
   


   <meta name="viewport" content="width=device-width, initial-scale=1.0">


      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./styleagent.css">
 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
 
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>


 body{
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
 }
 #ffff{
    
   
 }
 
.logoimageFirst{
    width:150px;
    height:80px;
    padding:5px;
}
 .heghttt{
    height:70px;
    /*padding-top:0px;*/
    /*margin-top:0px;*/
 }
 @media (max-width: 767px) {
        .heghttt{
            height:auto;
 padding-top:0px;
    margin-top:0px;
        }
        
    .logoimageFirst{
    width:140px;
    height:74px;
    }
    }

    .hoverdropdown:hover {
            display: block;
            background-color: #9932cc;
            color:white;
            cursor: pointer;

    }
    .swal2-timer {
            background-color: #ff0000; /* Change this color to your desired color */
        }
    /**lets make this float action button container amazing and increadable and when the + icons click  */
    .fab-container{
        position:fixed;
bottom: 20px;
right:20px;       

    }
 .fab-btn{
        position: relative;
        background-color: #9932cc;
        height: 50px;
        width:50px;
        border-radius: 50px;
        /**lets make the border color f9f9f9 */
        border: 2px solid #f9f9f9;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size:24px;
        z-index: 1;

    
 }
 .fab-btn:hover{
    transform: scale(1.1);
 }
 
 /**lets make the float action button roatet continously */
 
</style>
</head>
<body>
    
    <!-- color of backgroun-color: #5db75d-->

<header>
    <!-- nabbar-responsive-->


<nav  class="navbar navbar-expand-lg shadow fixed-top heghttt" style="background-color: #ffff;">



    
    
    
        <a class="navbar-brand">
            <img class="rounded-circle logoimageFirst"   src="./logo.png"/>
            </a>     
            <button class="navbar-toggler" data-bs-target="#collapseones" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>  
    
        
        <!--//===============================div class row===>-->
        
        <div class="d-flex flex-row">
            
            <div class="d-flex flex-row">
                    <?php


if(isset($_SESSION['agentcode']) && isset( $_SESSION['username']) ){
    if($_SESSION['Type']==0){
        ?>
                <form class="d-flex ms-5">

<div class="input-group">
    
<!-- <input class="form-control" list="searchresultss" name="searchpromocode" id="searchpromocode" type="text" placeholder="search the agent code"> -->

<select id="" class="form-select searchresultss">
<option>Select Promocode</option>
<!-- <option >eee1</option>
<option >eee2</option>
<option>eee2</option> -->

</select>
</div>


</form>

        <?php
    }
}


?>
            </div>
            
            
            
            
             <!--second column-->
                     <div class="d-flex me-auto" style="margin-left: 50px;">

            <span class="d-flex mx-2 d-none d-lg-block d-xl-block d-md-none d-sm-none">


     <?php

if(isset($_SESSION['agentcode']) && isset($_SESSION['username'])){

  $type= $_SESSION['Type'];
  if($type==0){
    echo "<span class='' style='fontweight:bold;color:black;font-size:18px;'>Facilitator</span>";
  }
  else{
    echo "Salles";
  }
    
    }


?>

            </span>
       <span class="form-control badge bg-success mx-2" id="selectedPromocode" style="font-size: 15px;">


       <?php

// session_start();


if(isset($_SESSION['agentcode']) && isset($_SESSION['username'])){

    echo $_SESSION['agentcode'];
    
}
else{
    echo "Welcome Guest";
}

?>
       </span>
       </div>
            
        </div>
        
   
       
       
       
        <div class="collapse navbar-collapse" id="collapseones">
 
    
    
            <ul class="navbar-nav ms-auto  ">
    
            <li class="nav-item m-1 mr-1 p-1">


<div class="dropdown">
<button type="button" class="btn  fs-10  dropdown-toggle" data-bs-toggle="dropdown">More</button>

<div class="dropdown-menu dropdown-menu-end ">
    <a class="dropdown-item hoverdropdown" href="#" id="addstudents"><img src="img/add students.svg" alt="add student" width="35" height="35">Add students</a>
    <a class="dropdown-item hoverdropdown" href="#Agentaddstudentslist" id="showstudentslists"><img src="img/students.png" alt="add student" width="35" height="35">Show Students</a>
    <!-- <a class="dropdown-item hoverdropdown" href="">Edit profile</a> 
    <a class="dropdown-item hoverdropdown" href="logout.php">Logout</a> -->
</div>
    </div>

</li>
                <li class="nav-item m-1 p-1">
                    <a href="#" class="nav-link  text-capitalize btn rounded-5 fs-10 me-5" style="border:1px solid #9932cc;color:black;">Dashboard agent</a>
                </li>
             
                
                
                <!-- <li class="nav-itme">
                    <a href="http://localhost/server/moodle/?redirect=0" class="nav-link text-dart text-capitalize fs-10">Home</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="http://localhost/server/moodle/my/" class="nav-link text-dark text-capitalize fs-10">Dashboard</a>
                </li></li>     -->
                <li class="nav-item m-1 mr-1 p-1">


                <div class="dropdown">
                <button type="button" class="btn btn-secondary fs-10  rounded-pill dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-fill" class="font-size: 20px;"></i></button>

                <div class="dropdown-menu dropdown-menu-end ">
                    <a class="dropdown-item hoverdropdown" href="">Dashboard</a>
                    <a class="dropdown-item hoverdropdown" href="">Profile</a>
                    <a class="dropdown-item hoverdropdown" href="">Edit profile</a> 
                    <a class="dropdown-item hoverdropdown" href="logout.php">Logout</a>
                </div>
                    </div>
                
                </li>
            </ul>
        </div>
    

    
    
    
    
    </nav>
    
</header>


<!-- modal show for students  for adding students--->

<div class="modal fade" id="addStudentsmodal" tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modaladdStudentsmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">

            <h5 class="modal-title">Registration form</h5>
                <button type="button"
                
                type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
               
            </div>


            <div class="modal-body">
                

         <div class="container mt-2 p-2">
        
            <form id="addstudentform">
            <span class="text-danger" id="sNerror"></span>
                <div class="input-group mb-2 p-2">
                   
                    <label class="input-group-text"><img src="img/student.png" alt="school" width="30" height="30"></label></label>

                <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Enter student name">

                </div>
                <span class="text-danger" id="sPherror"></span>
                <div class="input-group mb-2 p-2">
                    <label class="input-group-text"><img src="img/phone.png" alt="school" width="25" height="25"></label>

                <input type="number" class="form-control" id="studentphone" name="studentname" placeholder="Enter student phone">

                </div>
                <span class="text-danger" id="sScerror"></span>

                <div class="input-group mb-2 p-2">
                    <label class="input-group-text"><img src="img/school.png" alt="school" width="30" height="30"></label>

                <input type="text" class="form-control" id="studentschool" name="studentschool" placeholder="Enter student school">

                </div>
                <span class="text-danger" id="sFaerror"></span>

                <div class="input-group mb-2 p-2">
                    <label class="input-group-text"><img src="img/family.png" alt="family" width="30" height="30"></label>

                <input type="text" class="form-control" id="studentfamily" name="studentfamily" placeholder="Family phone">

                </div>
                
               


                <input type="hidden" class="form-control" id="agentCode" name="studentfamily"  value="<?php  echo $_SESSION['agentcode'];?>" placeholder="Family phone">

                

              <div class="mb-2 p-2">
              <button type="button" class="btn btn-primary mt-2 btn-sm" id="submitstudent">Submit</button>
              </div>
            </form>
         </div>

            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>
</div>

<!-- Button trigger modal -->

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
</script>


<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>



<div class="container mt-5">
   <input type="hidden" id="agentcodehidden" value="<?php echo $_SESSION['agentcode']; ?>">
</div>

<div class="mt-5 p-3">
    
</div>

<div class="container mt-5 p-3 bg-light">

<div class="row">

<div class="col-sm-4 justify-content-center border">

<div class="row">

<div class="col-4">
<div class="container shadow-sm rounded-circle p-2 mt-4">
<i class="bi bi-person-lines-fill d-flex justify-content-center p-3 text-success" style="font-size: 60px;"></i>
</div>
</div>
<div class="col-8">
<div class="container mt-4 p-4">
<p class="text-dark fs-10 p-2"><span class="badge bg-primary" id="totalloged">44</span></p>
<p>Total applied users</p>
</div>
</div>
</div>

</div>

<div class="col-sm-4 justify-content-center border">
<div class="row">
<div class="col-4">
<div class="container border-info shadow-sm rounded-circle p-2  mt-4" id="">
<i class="bi bi-person-check-fill text-info d-flex justify-content-center p-3" style="font-size: 60px;"></i>

</div>
</div>
<div class="col-8">
<div class="container mt-4 p-4">
<p class="text-dark "><span class="badge bg-success" id="totalpayedpromo">44</span></p>
<p class="text-dark">Total payed users </p>
</div>
</div>

</div>
</div>



<div class="col-sm-4 justify-content-center border">

<div class="row">
    <div class="col-4">
    <div class="container border-info shadow-sm rounded-circle p-2  mt-4" id="">
<i class="bi bi-person-fill text-secondary d-flex justify-content-center p-3" style="font-size: 60px;"></i>

</div>

    </div>
    <div class="col-8">
  <div class="container mt-4 p-4">
  <p class="text-dark fs-10 p-2"><span class="badge bg-danger" id="totcommented">44</span></p>
  <p>Total unpayed Users</p>
  </div>
    </div>
</div>
</div>

<!-- <div class="col-sm-3">
<p class="text-dark fs-10"><span class="badge bg-info">45</span></p>
<p>Today Rejected Students</p>
</div> -->
</div>
</div>
</div>


<div class="container mt-3 p-3">


<div class="row">

<div class="col-sm-6">
<canvas id="barGraph" class="" width="300" height="200"></canvas>
</div>
<div class="col-sm-6">

<div class="container-fluid">
    <p class="text-center text-capitalize text-dark fs-24 p-3">Advanced search</p>
  
    <div class="mt-1" >
    <div class="form-floating flex-fill p-2">
    <select id="searchresultss" class="form-select searchresultss">
<option>Select Promocode</option>
<!-- <option >eee1</option>
<option >eee2</option>s
<option>eee2</option> -->

</select>
        </div>
        <div class="form-floating flex-fill p-2">
            <input id="startDate" class="form-control" type="date" id="startDate">
            <label for="startDate">Start Date</label>
        </div>
   
        <div class="form-floating flex-fill p-2">
            <input id="endDate" class="form-control" type="date" id="endDate">
            <label for="endDate">End Date</label>
        </div>
   
        <div class="p-2">
            <button type="button" class="btn text-white mt-1" style="background-color:#9932cc;" id="findButton">Find</button>
        </div>
    </div>
</div>
</div>
</div>

<div class="mt-2" style="display:none;" id="showmewhen">
<div  class="container mt-2 p-5 d-flex justify-content-center align-item-center">
    <div class="spinner-grow justify-content-center bg-info m-2" role="status">
        <!-- <span class="visually-hidden">Loading...</span> -->
    </div>
    <div class="spinner-grow justify-content-center bg-success m-2" role="status">
        <!-- <span class="visually-hidden">Loading...</span> -->
    </div>
    <div class="spinner-grow justify-content-center bg-warning m-2" role="status">
        <!-- <span class="visually-hidden">Loading...</span> -->
    </div>
</div>

</div>


<div class="container mt-3 p-3" id="advancedresultshow" style="display: none;" >

<p class="text-center">Promocode: <span id="promocodeidss"></span></p>

<div class="d-flex  mt-2 p-3">
    <div class="container justify-content-center m-2 p-2 shadow-sm flex-fill">

    <i class="bi bi-person" style="font-size: 25px;"></i><p class="mt-1 p-1">Total registerd users: <span class="badge bg-info" id="totalregistredadvanced">0000</span></p>
    </div>
    <div class="container m-2 p-2 shadow-sm flex-fill">


    <i class="bi bi-person-check" style="font-size: 25px;"></i><p class="mt-1 p-1">Total payed users: <span  class="badge bg-success" id="totalpayedadvanced">0000</span></p>
    </div>
    <div class="container m-2 p-2 shadow-sm flex-fill">
        
    <i class="bi bi-person-dash" style="font-size: 25px;"></i><p class="mt-1 p-1">Total unpayed user: <span class="badge bg-warning" id="totalunpayedusers">0000</span> </p></div>

</div>

<button class="btn btn-primary btn-sm" id="PrintData" type="button">Print</button>
</div>





</div>


<div class="modal fade" tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true" id="mymodal">

<div class="modal-dialog">
    <div class="modal-content">
        
        <div class="modal-header">
          <p class="modal-title p-2 text-danger text-center t" style="font-size: 20px;"><strong>Alert</strong></p>

            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            
        </div>
        <div class="modal-body">
            <p id="errormessage">modal body</p>
        </div>

        <div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #9932cc;">Close</button>
        </div>
    </div>
</div>
</div>



<!--  second modal when the print button clcik -->


<div class="modal fade"  tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true" id="modalPrint">
    <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

    <div class="modal-header">
        <p class="modal-title">Printable Data<span></span></p>
        <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
    </div>
    <div class="modal-body">

    <div class="container mt-4 p-2">
<div class="row">

<div class="col-sm-4">
<a class="navbar-brand">
            <img class="rounded-circle"  width="140" height="90" src="./logo.png"/>
            </a>
</div>


<div class="col-sm-8">
<div class="container mt-3 p-3 d-flex flex-fill justify-content-end"><p class="text-capitalize text-dark fs-24"><strong>Day of Print:</strong> <span id="printdate"></span></p></div>
</div>
</div>

<div class="container mt-2 p-3">
    <p class="textromanstyle">Agent Code: <span id="printpromocode"></span></p>
</div>
<div class="d-flex justify-content-between mt-2 p-3">

<p>Start Date: <span id="startdateprint"></span></p>
<p>End Date: <span id="enddateprint"></span></p>
</div>


<div class="d-flex justify-content-between mt-2 p-3">
    <div class="container  m-2 p-2 shadow-sm flex-fill">

    <i class="bi bi-person" style="font-size: 25px;"></i><p class="mt-1 p-1">Tot users :</p>
    <span class="badge bg-info" id="totalregistredprint">44</span>
    </div>
    <div class="container m-2 p-1 shadow-sm flex-fill">


    <i class="bi bi-person-check" style="font-size: 25px;"></i><p class="mt-1 p-1">Payed users :</p><span  class="badge bg-success" id="totalpayedprint">33</span>
    </div>
    <div class="container m-2 p-1 shadow-sm flex-fill">
        
    <i class="bi bi-person-dash" style="font-size: 25px;"></i><p class="mt-1 p-1">Unpayed user : </p>

    <span class="badge bg-warning" id="totalunpayedprint">2</span>
</div>

</div>

<div class="container mt-2 p-3">
    <p>Signiture : </p>
</div>


<div class="container mt-2 p-3">
    <p></p>
</div>

    </div>

    </div>
    <div class="modal-footer">
<button type="button" class="btn btn-secondary" id="printnowbutton">Print Now</button>
    </div>
    </div>
    </div>
</div>

<div class="fab-container">
    <button type="button" class="btn btn-secondary fab-btn" id="tableshowbutton"><i class="bi bi-table" style="color:#F1D084;"></i></button>
</div>

<!-- lets make data table for displaying the student data who are not payed yet--->

<div class="container mt-5 p-3 shadow-sm table-responsive" id="containertable" style="display:none;">

<div class="container p-2 border-info">
<p class="text-capitalize text-dark fs-24"><img src="img/studentss.png"  width="50" height="50">  <span class="ml-3 p-2">unpayed Students Table</span></p>
<hr>
</div>
<table class="table  table-striped table-hover" id="unpayedStudenttable">
<thead>
    
<tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Grade</th>
    <th>Phoned</th>
</tr>
</thead>

<tbody>


<?php
$promoid= $_SESSION['agentcode'];






//========lets second code for displaying the payed students
$sql = "SELECT DISTINCT(mdl_userid), grade, tb_id AS tbid, tc_id AS tcid, phoned FROM (
    SELECT tr.mdl_userid AS mdl_userid, tr.course_name AS grade, tr.id AS tb_id, NULL AS tc_id, tr.phoned AS phoned
    FROM transaction_bank_new tr
    JOIN `students` st ON st.agent_code = tr.promo 
    WHERE (status = 1 OR status IS NULL OR status = 0) AND tr.promo=?
    
    UNION ALL
    
    SELECT ck.mdl_userid AS mdl_userid, ck.course_name AS grade, NULL AS tb_id, ck.id AS tc_id, ck.phoned AS phoned
    FROM checkout_new ck
    JOIN `students` st ON st.agent_code = ck.promo
    WHERE status = 0 AND ck.promo=?
) AS combined_tables;";

$stmt = $conn3->prepare($sql);
$stmt->bind_param('ss', $promoid,$promoid);
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mdl_userid = $row['mdl_userid'];
        $grade = $row['grade'];
        $tb_id = $row['tbid'];
        $tc_id = $row['tcid'];
        $isphoned=$row['phoned'];
       // var_dump($mdl_userid);
       $decodegrade=json_decode($grade,true);
      
        $sql2 = "SELECT * FROM `mdlwj_user_info_data` WHERE `userid` = ? AND fieldid = 5";
        $stmt2 = $conn2->prepare($sql2);
        $stmt2->bind_param('i', $mdl_userid);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $phonenumber = $row2['data'];
          
           

            $sql3 = "SELECT * FROM `students` WHERE `phone` = ?";
            $stmt3 = $conn3->prepare($sql3);
            $stmt3->bind_param('s', $phonenumber);
            $stmt3->execute();
            $result3 = $stmt3->get_result();

            if ($result3->num_rows > 0) {
                $row3 = $result3->fetch_assoc();
            
              
                

                // $response[] = [
                //     'phone_number' => $phonenumber,
                //     'grade' => $grade,
                //     'name' => $row3['name'],
                //     'family_phone' => $row3['family_phone'],
                //     'tb_id' => $tb_id,
                //     'tc_id' => $tc_id,
                //     'agent_code' => $row3['agent_code'],
                // ];

                ?>
                 <tr>
                    <td><?php echo $row3['name'] ;?></td>
                    <td><?php  echo $phonenumber  ;?></td>
                    <td><?php 
                    
                    if(is_array($decodegrade)){
                        echo implode(", ", $decodegrade);
                    }
                  ?></td>
              
              <td>

              <?php 
              $checkvalue=$isphoned;?>

<input type='checkbox'

<?php if($checkvalue==1){
    echo "checked";
} 
else{
echo "unchecked";
} ?>
 class='form-check-input userChange'  data-tbid="<?php echo $tb_id ?>" data-tcid="<?php echo $tc_id; ?>">

             
              </td>

                </tr>



<?php
            }
        }
    }
}


?>
</tr>
<!-- <tr>
<td>Kebede</td>
<td>0978634</td>
<td>Grade 12 social</td>
<td><button type="button" class="btn btn-success">End</button></td>
    </tr> -->
    </tbody>
</table>
</div>

<!----tabel show of students data registered by agent code----->


<div class="container mt-5 p-3 shadow-sm "  id="Agentaddstudentslist" style="display:none">



<p><img src="img/student.png" width="40" height="40"><span class="ml-3 p-2">Students Lists</span></p>
<hr>
    <div class="table-responsive">
        <table class="table  table-striped table-hover" id="Agentaddstudentslisttables">
            <thead>
                <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>School</th>
                <th>Family_phone</th>

                </tr>
            </thead>
            <tbody>
<?php


$sqlstudent="SELECT * FROM `students` WHERE agent_code=?";
$stmtstudent=$conn3->prepare($sqlstudent);
$stmtstudent->bind_param('s',$promoid);
$stmtstudent->execute();
$resultstudent=$stmtstudent->get_result();

if($resultstudent->num_rows>0){
    while($rowstudent=$resultstudent->fetch_assoc()){
        $name=$rowstudent['name'];
        $phone=$rowstudent['phone'];
        $school=$rowstudent['school'];
        $family_phone=$rowstudent['family_phone'];
        ?>
         <tr>
            <td><?php echo $name ;?></td>
            <td><?php  echo $phone  ;?></td>
            <td><?php  echo $school  ;?></td>
            <td><?php  echo $family_phone  ;?></td>

        </tr>
         <?php
    }
}

?>


               
            </tbody>
            </table>
    </div>
</div>


<!----end of tabel show of students data registered by agent code----->


<!--  the modal show -->
  
<!-- Button trigger modal -->

<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>
<script src="controller.js"></script>





   

<footer class="container-fluid mt-3 p-3" style="background-color: #8dc63f;">

<div class="container">
   <!-- 
   -->


   <div class="row">
    <div class="col-sm-3">
        <p class="text-white">Navigation</p>

            <p class="text-white"></p>
            <p class="text-white"></p>
            <p class="text-white"></p>

            <ul class="list-unstyled">
                <li ><a href="" class="text-decoration-none text-white fs-20" style="font-size: 12px;">Home</a></li>
                <li><a href="" class="text-decoration-none text-white fs-10" style="font-size: 12px;" >Dashboard</a></li>
                <li><a href="" class="text-decoration-none text-white text-sm" style="font-size: 12px;">My Subject</a></li>

            </ul>


    </div>
  <hr class="bg-white text-white">
  

  
   </div>

   <div class="row p-3">

   <div class="col-sm-4">
<img src="./logofooter.png"  width="200" height="50" />
   </div>
   <div class="col-sm-4 mt-2">
   <p class="text-white">Terms and Condition</p>
    </div>
    <div class="col-sm-4">
    <p class="text-white">Ethiotelecom eTemari © 2024. All rights reserved.</p>
    </div>
    
   </div>
</div>


</footer>
</body>




<script type="text/javascript">
    $('document').ready(function(){



        $('#Agentaddstudentslisttables').DataTable({});







        /**@abstract
         * unpayed student data table ifoamtion
         */

         $('#unpayedStudenttable').DataTable({});


$('#tableshowbutton').on('click',function(){
    $('#Agentaddstudentslist').hide();
    $('#containertable').toggle();

});




$('.userChange').change(function(){

    var tbid=$(this).data('tbid');
    var tcid=$(this).data('tcid');
    var checkvalue=0;
    // var promoid=$('#agentcodehidden').val();

if($(this).is(':checked')){
    checkvalue=1;
    console.log('the user checked');
    console.log('the tbid is '+tbid);   
    console.log('the tcid is '+tcid);   
    console.log('the checkbvalue is '+checkvalue);   

  
}
else{
    checkvalue=0;
    console.log('the user unchecked');
    console.log('the tbid is '+tbid);   
    console.log('the tcid is '+tcid); 
    console.log('the checkbvalue is '+checkvalue);   
}

/** lets make ajaz request for chening the phoend column in transaction_bank and check out table */


$.ajax({

    url:'updatephoned.php',
    method:'POST',
    data:{tbId:tbid, tcId:tcid, checkValue:checkvalue},
    success:function(response){
        console.log('successfully updated the phoned value');
        console.log('the response is '+response);


    },error(xhr,status,error){

        console.log('error in updating the phoned value');
    }
});
    
});




var globalagentcode=$('#agentcodehidden').val();


      //===================end of bar graph code 

        const urlParams = new URLSearchParams(window.location.search);
    const showModal = urlParams.get('showModal');
    
    // If 'showModal' is true, show the modal
    if (showModal === 'true') {
        
        $('#mymodal').offcanvas('show'); // Show the modal

        // Optionally, remove 'showModal' from the URL to avoid it staying there after the modal is displayed
        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?messageid=' + urlParams.get('messageid');
        window.history.replaceState(null, null, newUrl);
    }


//when search of proomo code is clicked

// $('#searchresultss').on('change',function(){

//     const searchValue=$(this).val();


   



// // $('#searchresultss').on('click','', function() {
// //         $(this).on('change', function() {
// //             const selectedValue = $(this).val();
// //             sessionStorage.setItem('selectedPromoCode', selectedValue);
// //             console.log('Selected promocode stored in session:', selectedValue);
// //         });
// //     });



// });


$.ajax({
    url:'Facilitator/searchpromocode.php',
    method:'POST',
    data:{promoCode:globalagentcode},
    success:function(response){
        console.log('the value is successed');

        const SearchResults=JSON.stringify(response);
        const Searchbox=$('.searchresultss');

        Searchbox.empty();//clear previous search
   // Append the "Select Promocode" option
   Searchbox.append('<option id="selectboxfirst" value="">Select Promocode</option>');

        if(response.length >0){
         response.forEach(result=>{



            Searchbox.append(`<option  value="${result}">${result}</option>`);

         });
         Searchbox.show();
        }
        else{
            Searchbox.hidden();
        }

     
        console.log('the dat searched is'+response);
    },
    error:function(xhr,status,error){
        console.log('erro in seraching the values');
        
    }
});




//===========================searchresult two ================================
$.ajax({
    url:'searchpromocode.php',
    method:'POST',
    data:{},
    success:function(response){
        console.log('the value is successed');

        const SearchResults=JSON.stringify(response);
        const Searchbox=$('#searchresultsstwo');

        Searchbox.empty();//clear previous search
   // Append the "Select Promocode" option
   Searchbox.append('<option value="">Select Promocode</option>');

        if(response.length >0){
         response.forEach(result=>{



            Searchbox.append(`<option  value="${result}">${result}</option>`);

         });
         Searchbox.show();
        }
        else{
            Searchbox.hidden();
        }

     
        console.log('the dat searched is'+response);
    },
    error:function(xhr,status,error){
        console.log('erro in seraching the values');
        
    }
});



//===========modal add students show

$('#addstudents').on('click',function(){


    $('#addStudentsmodal').modal('show');
});
    });

var catagoryids=[];





  /**
     * ajax for updating the status for reject button
     */



$(document).ready(function(){

    var globalagentcode=$('#agentcodehidden').val();
    $('.searchresultss').on('change',function(){



        
        //=======lets disable the select promoCode option if it select one



var selectedPromoCode=$(this).val();

//====lets disbale the option Select Promocode
$(this).find('option:contains("Select Promocode")').prop('disabled',true);
console.log('the selected promocode is '+selectedPromoCode);
$('#selectedPromocode').html(selectedPromoCode);

var newUrl=window.location.protocol+ "//"+ window.location.host +window.location.pathname+ '?promoid='+ selectedPromoCode;
window.history.replaceState(null,null,newUrl);



UpdateOnlineusers(selectedPromoCode,'true');
Bargraphsystem(selectedPromoCode,'true');

// location.reload();

});



//===============method when searchresult wo clicked============================

$('#searchresultsstwo').on('change',function(){



var selectedPromoCode=$(this).val();

console.log('the selected promocode is '+selectedPromoCode);
$('#selectedPromocode').html(selectedPromoCode);

var newUrl=window.location.protocol+ "//"+ window.location.host +window.location.pathname+ '?promoid='+ selectedPromoCode;
window.history.replaceState(null,null,newUrl);



UpdateOnlineusers(selectedPromoCode,'true');
Bargraphsystem(selectedPromoCode,'true');

// location.reload();

});


function UpdateOnlineusers(promoid,isIndivisual) {
    var totalenteruser = 0;
    var totalpayedusers = 0;

    // Function to update unpaid users count
    function updateUnpayedUsers() {
        var totalunpayedusers = totalenteruser - totalpayedusers;
        $('#totcommented').text(totalunpayedusers);
    }

    // Fetch total entered users
    $.ajax({
        url: 'totpromoenteruser.php',
        method: 'POST',
        data: { promoid: promoid, indivisualValue:isIndivisual },
        success: function (response) {
            console.log('Response for entered users: ' + response);
            totalenteruser = parseInt(response) || 0; // Ensure it's a number
            $('#totalloged').text(totalenteruser);
            updateUnpayedUsers(); // Update unpaid users after this value is fetched
        },
        error: function (xhr, status, error) {
            console.log('Error fetching entered users: ', error);
        }
    });

    // Fetch total paid users
    $.ajax({
        url: 'totpayedpromo.php',
        method: 'POST',
        data: { promoid: promoid, indivisualValue:isIndivisual },
        success: function (response) {
            console.log('Response for paid users: ' + response);
            totalpayedusers = parseInt(response) || 0; // Ensure it's a number
            $('#totalpayedpromo').text(totalpayedusers);
            updateUnpayedUsers(); // Update unpaid users after this value is fetched
        },
        error: function (xhr, status, error) {
            console.log('Error fetching paid users: ', error);
        }
    });
}


UpdateOnlineusers(globalagentcode,'false');//update in 1000 microsecods



//=====line graph for weekly graph

let myChart = null; // Declare this variable outside the function to hold the chart instance

function Bargraphsystem(promoid,indivisual) {

    console.log('the promoid is '+promoid);
    const ctx = document.getElementById('barGraph').getContext('2d');

    // Fetch data based on promoid
    const url = promoid ? `weeklypromoid.php?promoid=${promoid}&indivisualValue=${indivisual}` : 'weekly.php';
    
    fetch(url)
    .then(response => response.json())
    .then(data => {
        const labels = [];
        const today = new Date();

        // Generate labels for the last 7 days
        for (let i = 6; i >= 0; i--) {
            const day = new Date(today);
            day.setDate(today.getDate() - i);
            labels.push(day.toLocaleDateString('en-US', { weekday: 'long' }));
        }

        const chartData = {
            labels: labels,
            datasets: [
                {
                    label: 'Registered users',
                    data: data.registereduser,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Payed users',
                    data: data.payedusers,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        };

        const options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // If chart already exists, update it
        if (myChart) {
            myChart.data = chartData;
            myChart.update(); // Update the existing chart with new data
        } else {
            // Create a new chart if one doesn't exist
            myChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: options
            });
        }
    })
    .catch(error => {
        console.error('Error occurred:', error);
    });
}

Bargraphsystem(globalagentcode,'false'); // Initialize the function




/**
 *  method and jquery funciton when find button is clciked
 * =============================find button is cliekd============
 */

 $('#findButton').on('click',function(){
    $('#advancedresultshow').hide();
// var promoid=$('#agentcodehidden').val();

var promoid=$('#searchresultss').val();
var startDate=$('#startDate').val();

var endDate=$('#endDate').val();
if(promoid=== ''){
    $('#errormessage').text('Promo code can not be null');
  $('#mymodal').modal('show');
    return;

}


if(startDate === ''){
    $('#errormessage').text('Start date is null');
    $('#mymodal').modal('show');
   
    return;
}

if(endDate === ''){
    $('#errormessage').text('End date is null');
    $('#mymodal').modal('show');
   
    return;
}


if(startDate > endDate){
    $('#errormessage').text('the Start date can not be greater than End date');
    $('#mymodal').modal('show');
   
    return;
}
 startDate=new Date(startDate);

 endDate=new Date(endDate);

var datenow=new Date();



if(startDate > datenow || endDate > datenow){
    $('#errormessage').text('the Start date or End date can not be greter than todays date');
    $('#mymodal').modal('show');
  
    return;
}

console.log('the promocode is'+promoid);
console.log('the start date'+startDate);
console.log('the end date'+endDate);
// console.log('the promocode is'+promoid);

// const startDateformat=startDate.toISOString().slice(0, 19).replace('T',' ');
// const endDateFormat=endDate.toISOString().slice(0, 19).replace('T',' ');

const startDateFormat = new Date(startDate).toISOString().slice(0, 19).replace('T', ' ');
// const endDateFormat = new Date(endDate).toISOString().slice(0, 19).replace('T', ' ');
const endDateFullDay = new Date(endDate).setHours(23, 59, 59, 999); // Adjust end date to include full day
const endDateFormat = new Date(endDateFullDay).toISOString().slice(0, 19).replace('T', ' ');

//let request ajax request
$('#showmewhen').show();

setTimeout(function(){

    
    $.ajax({

url:'advancedreport.php',
method:'POST',
data:{promoid:promoid,startDate:startDateFormat,endDate:endDateFormat},
success:function(response){
    $('#showmewhen').hide();
    $('#advancedresultshow').show();
    $('#promocodeidss').text(promoid);

    var data=JSON.parse(response);

    var totalunpayedusers=data.totalregisterpromocodeuser-data.totalpayedusers;
    
    if(data.totalregisterpromocodeuser === 0){
         $('#totalregistredadvanced').text(0);
        
    }
    else{
         $('#totalregistredadvanced').text(data.totalenteruser);
    }
   
    $('#totalpayedadvanced').text(data.totalpayedusers);
    $('#totalunpayedusers').text(totalunpayedusers);
    console.log('the response is '+response);


    //=====when print  button is clicked=====

    $('#PrintData').on('click',function(){

        //show modal button for printing

        $('#modalPrint').modal("show");
        const options={year:'numeric', month:'long',day:'numeric'};
        const FormatedDate=new Date().toLocaleDateString(undefined,options);

        $('#printdate').text(FormatedDate);
        $('#printpromocode').text(promoid);
        const startFormateddateprint=startDate.toLocaleDateString(undefined,options);
        const endFormateddateprint=endDate.toLocaleDateString(undefined,options);
        $('#startdateprint').text(startFormateddateprint);
        $('#enddateprint').text(endFormateddateprint);
        $('#totalregistredprint').text(data.totalenteruser);
        $('#totalpayedprint').text(data.totalpayedusers);
        $('#totalunpayedprint').text(totalunpayedusers);
        


        //============when print now button is clciked=====
       // Add a click event listener to the "Print Now" button
$('#printnowbutton').on('click', function() {
    // Create a new window for printing
    var printWindow = window.open('', '_blank');

    // Get the content of the modal body
    var modalBodyContent = $('#modalPrint .modal-body').html();

    // Write the modal body content to the new window
    printWindow.document.write('<html><head><title>Printable Data</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>');
    printWindow.document.write(modalBodyContent);
    printWindow.document.write('</body></html>');

    // Print the content in the new window
    printWindow.print();

    // Close the new window after printing
    printWindow.close();
});
    });
    
 
},
error:function(xhr,status,error){
console.log('error courred'+error);
$('#showmewhen').hide();

}
});
    
},1000);



    







 });


 /**
  * ajax query for fethcing the total numebr of lesson downlaods
  */





//update with 10 second

 
});//end of doucmnet




/**@
 * second table javascript and jquery
 * this belowe code if for live logs
 */

 $('document').ready(function(){



//
$('#mysecondtable').DataTable();
var table2=$('#mysecondtable').DataTable();

 });




</script>
</html>

<?php


}

?>