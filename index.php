<?php



include('connection.php');
include('connection2.php');
include('functionclass.php');

// include('connection3.php');
require_once(__DIR__ . '/../../config.php');


// Get the session ID




if(isloggedin() && !isguestuser()){


 global $USER, $DB, $conn3,$conn;

$context = context_system::instance();

// Check if the user is an admin
$is_admin = has_capability('moodle/site:config', $context);
$is_student = user_has_role_assignment($USER->id, 5); // Role ID 5 assumed to be Student
// Check if the user is a manager (assuming role ID for manager is 1)
$is_manager = user_has_role_assignment($USER->id, 1);

// Check if the user is a teacher (assuming role ID for teacher is 3)
$is_teacher = user_has_role_assignment($USER->id, 3);

   if (!$is_student || $is_admin || $is_manager || $is_teacher  ) {
     // Query the mdl_session table to check if the session ID exists `timestamp` >= NOW() - INTERVAL 48 HOUR
  
     // Query the mdl_session table to check if the session ID exists
  


    //DelateusersafterTime($conn3);
    $sqlquery = "SELECT * FROM `transaction_bank_new` ORDER BY `timestamp` ASC ";
    $stmt = $conn3->prepare($sqlquery);
    $stmt->execute();
    $resultstmt = $stmt->get_result();

    } else {
        // Redirect students or unauthorized users to an error or login page
        ?>
    <html>
        <head>
            <title>Error page</title>
        </head>
        <body>
        </body>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            Swal.fire({
                title: 'Error',
                text: 'You are not authorized to access this page',
                icon: 'error',
                  width:"400px",
                  height:"70px",
                  showConfirmButton: true,
                  showCancelButton:false,
               
                confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes"
}).then((result)=>{
   if(result.isConfirmed){
    window.location.href='http://etemari.net/my';
   }
               // 3 seconds
            });
        </script>
    </html>
    <?php
    exit;
    }



    
} else {
    // Session ID not provided in the Moodle config file, show an error message
    ?>
    <html>
        <head>
            <title>Error page</title>
        </head>
        <body>
        </body>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            Swal.fire({
                title: 'Error',
                text: 'Session ID not provided. Access denied. Do you want to login',
                icon: 'error',
                  width:"400px",
                  height:"70px",
                  showConfirmButton: true,
                  showCancelButton:true,
               
                confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes"
}).then((result)=>{
   if(result.isConfirmed){
    window.location.href='https://etemari.net/login/index.php';
   }
               // 3 seconds
            });
        </script>
    </html>
    <?php
    exit;
}


  


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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>


 body{
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
 }
 #ffff{
    
   
 }

 .heghttt{
    height:70px;
 }
 @media (max-width: 767px) {
        .heghttt{
            height:auto;

        }
    }
    /**let make the background color of drop down item transparent */
 .drop-down{
    background-color: white;
    border: none;
    color: #fff;
    font-size: 16px;
    font-weight: 500;
    /**let add box shadow balck when the drop down is displayed */
    box-shadow: 0px 0px 3px 0px black;
    /**let add border radius to the drop down */
    border-radius: 5px;
    /**let add padding to the drop down */
    padding: 10px;
    transition: all 0.2s ease;

 }
 .drop-down-item{
    background-color: transparent;
    border: none;
    color: black;
    font-size: 16px;
 }
 .drop-down-item:hover{
    /* background-color: #9932cc; */
 }
 .AgentType-fs{
    border: 1px solid #ecf9f2;
    border-radius: 10px;
    background-color: #ecf2f9;
    padding: 7px;
 
    /* padding: 10px; */

 }
 .AgentType-sa{
    border: 1px solid #fff;
    border-radius: 10px;
    background-color: #f0f0f5;
    padding: 5px;

 }
 .copyable-link {
    display: inline-block;
    padding: 5px 10px;
    background-color: #3498db; /* Blue background color */
    color: #fff; /* White text color */
    text-decoration: hyperlink; /* Remove underline */
    border-radius: 5px;
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.copyable-link:hover {
    background-color: #207ab4; /* Darker blue background color on hover */
    color: #fff; /* Maintain white text color on hover */
    cursor: pointer;
}
</style>
</head>
<body>
    
    <!-- color of backgroun-color: #5db75d-->

<header>
    <!-- nabbar-responsive-->


<nav  class="navbar navbar-expand-lg shadow fixed-top heghttt" style="background-color: #ffff;">



    
    
    
        <a class="navbar-brand">
            <img class="rounded-circle"  width="200" height="100" src="./logo.webp"/>
            </a>     
            <button class="navbar-toggler" data-bs-target="#collapseones" data-bs-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>  
            <form class="d-flex ms-5">

            <div class="input-group">
                
    <!-- <input class="form-control" list="searchresultss" name="searchpromocode" id="searchpromocode" type="text" placeholder="search the agent code"> -->

<select id="searchresultss" class="form-select">
<option>Select Promocode</option>
<!-- <option >eee1</option>
<option >eee2</option>
<option>eee2</option> -->

</select>


            </div>

            
            <div class="input-group">
                
    <!-- <input class="form-control" list="searchresultss" name="searchpromocode" id="searchpromocode" type="text" placeholder="search the agent code"> -->
<p class="p-1"></p>
<select id="searchFacilitatorCode" class="form-select">
<!-- <option>Select Facilitator</option> -->
<!-- <option >eee1</option>
<option >eee2</option>
<option>eee2</option> -->

</select>


            </div>
 

            </form>
            <div class="d-flex me-auto" style="margin-left: 50px;">
       <span class="form-control badge  ml-3" id="selectedPromocode"><span class="" style="color:#000;">All</span></span>
       </div>
        <div class="collapse navbar-collapse" id="collapseones">
 
    
    
            <ul class="navbar-nav ms-auto">
    
    
                <li class="nav-item me-2">
                    <a href="#" class="nav-link text-white text-capitalize btn rounded fs-10" style="background-color: #9932cc;color:white;">Dashboard sells agent</a>
                </li>
                <li class="nav-itme">
                    <a href="https://etemari.net/?redirect=0" class="nav-link text-dart text-capitalize fs-10">Home</a>
                </li>
                <li class="nav-item">
                    <a href="https://etemari.net/my/" class="nav-link text-dark text-capitalize fs-10">Dashboard</a>
                </li></li>    
                <!--<li class="nav-item">-->
                <!--    <a href="https://etemari.net/admin/search.php" class="nav-link text-dark text-capitalize fs-10">Site Adminstation</a>-->
                <!--</li>-->
                <li class="nav-item">
                    <a href="./login.php" class="nav-link text-dark text-capitalize fs-10 btn-outline-success"><button class="btn btn-outline-success">Login</button></a>
                </li>
            </ul>
        </div>
    

    
    
    
    
    </nav>
    
</header>

<div class="container mt-5">
    <p>'dgrg</p>
</div>

<div class="mt-5">
    
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
<p>Total registerd users</p>
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
<div class="row">

<div class="col-sm-10 p-2 mt-4">


<div class="container p-4">
<p class="text-dark "><span class="badge bg-success" id="totalpayedpromo">44</span></p>
<!-- protexct text overflowed-->

<p class="text-dark">Total payed users </p>
</div>


</div>
<div class="col-2 d-flex flex-column mt-3">

<button type="button" class="btn btn-sm " data-bs-toggle="dropdown"> <i class="bi bi-three-dots-vertical"></i></button>

<!--let make the backgroun-color of the dropdown-item white or trans-->
<!--<div class="d-flex flex-row">-->
<!--    <div class="p-2">-->
<!--        <p>Grade 12</p>-->
        
<!--    </div>-->
<!--</div>-->
<!-- 
<p class="dropdown-item">Grade 9  |<span class="text-info ml-2">45</span></p>
    <p class="dropdown-item">Grade 10 |<span class="text-success ml-2">45</span></p>  
    <p class="dropdown-item">Grade 11 | <span class="ml-2" style="color: #9932cc;">45</span> </p>  
    <p class="dropdown-item">Grade 12 |<span class="ml-2" style="color: #8dc63f;;"> 45</span></p>  
    <p class="dropdown-item">Grade 12 and ESSLCE |<span class="ml-2" style="color:aqua;">45</span></p>   -->
<div class="drop-down dropdown-menu dropdown-menu-end">
  <div class="drop-down-item p-2 mt-2">
       <div class="d-flex flex-row justify-content-start align-items-center">
    <div class="p-1">
        
         <p>3Monthly: <span class="badge bg-primary"  id="monthysubscirbe">0000</span></p>
       <p>6month: <span class="badge bg-info" id="3monthsubscriber">0000</span></p>

 <p>year: <span class="badge bg-dark" id="6monthsubscriber">0000</span></p>
    </div>
 
      
  </div>
  <!--<table class="table table-hover table-bordered bg-light">-->
  <!--  <tr>-->
  <!--      <th>Grade</th>-->
  <!--      <th>Total</th>-->
  <!--  </tr>-->
  <!--  <tbody>-->
  <!--      <tr>-->
  <!--          <td>Grade 9</td>-->
  <!--          <td id="grade9">0000</td>-->

  <!--      </tr>-->
  <!--      <tr>-->
  <!--          <td>Grade 10</td>-->
  <!--          <td id="grade10">0000</td>-->
            
  <!--      </tr>   <tr>-->
  <!--          <td>Grade 11 Natural</td>-->
  <!--          <td id="grade11N">0000</td>-->
            
  <!--      </tr>  -->
  <!--      <tr>-->
  <!--          <td>Grade 11 Social</td>-->
  <!--          <td id="grade11S">0000</td>-->
            
  <!--      </tr>-->
        
        
  <!--      <tr>-->
  <!--          <td>Grade 12 Natural</td>-->
  <!--          <td id="grade12N">0000</td>-->
            
  <!--      </tr>-->
            
  <!--      <tr>-->
  <!--          <td>Grade 12 Social</td>-->
  <!--          <td id="grade12S">0000</td>-->
            
  <!--      </tr>-->
        
  <!--       <tr>-->
  <!--          <td>ESSLCE Natural</td>-->
  <!--          <td id="esslceNatural">0000</td>-->
            
  <!--      </tr>-->
  <!--       <tr>-->
  <!--          <td>ESSLCE Social</td>-->
  <!--          <td id="esslceSocial">0000</td>-->
            
  <!--      </tr>-->
        
  <!--  </tbody>-->
  <!--</table>-->
  
 
  </div>

</div>

</div>
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


<div class="container mt-3">


<div class="row">

<div class="col-sm-2">
  
<ul class="nav nav-pills  nav-justified flex-column shadow-sm">
    <li class="nav-item p-2">

    <a class="nav-link active" data-bs-toggle="tab" href="#home1"><span class="text-danger"><i class="bi bi-speedometer2 p-2" style="font-size: 20px;color:white;"></i> </span> Dashboard</a>
    </li>
<li class="nav-item p-2">

<a class="nav-link" href="#home2"  data-bs-toggle="tab"><span class="p-2 text-info"><i class="bi bi-person-circle" style="font-size: 15pxpx;"></i></span>Main Agents</a>
</li>

<li class="nav-item p-2">
    <a class="nav-link" data-bs-toggle="tab"  href="#home3" ><span class="p-2 text-secondary"><i class="bi bi-search" style="font-size: 15px;"></i></span> Adv Search</a>
</li>

<li class="nav-item p-2">
    <a class="nav-link" data-bs-toggle="tab"  href="#home4" ><span class="p-2 text-secondary"><i class="bi-wallet-fill" style="font-size: 15px;"></i></span> Payment Req</a>
</li>

<!--<li class="nav-item p-2">-->
<!--    <a class="nav-link" data-bs-toggle="tab"><span class="p-2 text-success"><i class="bi bi-person-lines-fill"  style="font-size: 15px;"></i></span> Live Activity</a>-->
<!--</li>-->
</ul>
</div>

<div class="col-sm-10">


<div class="tab-content">
    <div class="tab-pane container active" id="home1" >


<!--- tab pane when clciked-->
<div class="row p-2 mt-2">
<h5 class="text-center p-2 text-capitalize text-dark fs-24">Weekly data</h5>
<!-- <div class="col-sm-6"> -->
<canvas id="barGraph" class="mb-2 p-3" width="300" height="140"></canvas>

<canvas id="barGraphSecond" class="mb-2 p-3" style="display: none;" width="300" height="140"></canvas>
<!-- </div> -->
<!-- <div class="col-sm-6"> -->


<!-- </div> -->
</div>

<!-- tab pnae one end --->


    </div>
    <div class="tab-pane container fade" id="home2">






  <div class="container mt-2 p-3">
  
  <div class="container  p-3">

  <h5 class="text-center">Agent detail infomation</h5>
  <button type="button" class="btn btn-sm mb-2" id="addagent" style="background-color: #9932cc;color: white;font-size:medium;"><span class="p-2"><i class="bi bi-person-plus"></i></span>Add agent</button>
  </div>
<div class="table-responsive">

<table class="table table-hover" id="agentstable">

 
<thead>
   <tr> 
    <th>Agent code</th>
    <th>Username</th>
    <th></th>
   
    <th>Status</th>
    <th>Link</th>
    <th>Type</th>
    <th>Parent</th>
    <th>Update</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>






</tbody>
</table>


<div class="modal fade" tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
    
     id="addagentmodal">

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header">
        <p class="modal-title text-center" style="font-size: 20px;">Agent Form</p>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
    </div>

    <div class="modal-body">
     <div class="container mt-2 p-2">
     <div class="alert alert-info alert-dismissable">


<strong>Info!</strong>Please create a simple promo code and click the activate button to activate the agent.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
     </div>

      

        <form id="addagentform">

<span class="text-danger p-1" id="agentTypes"></span>
<!----lets create a two radio box for chosing the agent type is fasicilitor or sells agent---->
<div class="input-group mb-2 p-2">
   
<div class="form-check form-check-inline">
    <input type="radio" name="agenttype" class="form-check-input" value="fasilitator" id="fasilitator">
    <label for="fasilitator" class="form-check-label">Facilitator</label>
</div>

<div class="form-check form-check-inline">
    <input type="radio" name="agenttype" class="form-check-input" value="fasilitator" id="salledagent">
    <label for="salles agent" class="form-check-label">Salles agent</label>
</div>
</div>



        <span class="text-danger p-1"  id="promocodeerror"></span>
        <div class="input-group mb-2 p-2">
            <label for="agentname" class="input-group-text"><span><i class="bi bi-upc-scan fs-20" style="font-size: 18px;"></i></span></label>
                <input type="text" name="agentname" id="agentpromocodeadding" class="form-control agentclass" placeholder="Enter the agent promo code" required>
           
            </div>
            <span class="text-danger p-1" id="agentnameerror"></span>
            <div class="input-group mb-2 p-2">
            <label for="agentname" class="input-group-text"><span><i class="bi bi-person-fill fs-20" style="font-size: 18px;"></i></span></label>
                <input type="text" name="agentname" id="agentname" class="form-control" placeholder="Enter the agent name" required>
             
            </div>
              <span class="text-danger p-1" id="passworderror"></span>
            <div class="input-group mb-2 p-2">

<label for="agentpassword " class="input-group-text" >
    <span><i class="bi bi-key-fill fs-20" style="font-size: 18px;"></i></span>
</label>
            <input type="text" name="password" id="agentpassword" class="form-control passwordclass" placeholder="Enter the agent password" required>

          
            </div>


            <span class="text-danger p-1" id="phoneerror"></span>
            <div class="input-group mb-2 p-2">

<label for="agentpassword " class="input-group-text" >
    <span><i class="bi bi-phone-fill fs-20" style="font-size: 18px;"></i></span>
</label>
            <input type="number" name="agentphone" id="agentphoneno" class="form-control myclass" placeholder="Enter the agent phone number" required>
          
            </div>


            <span class="text-danger p-1" id="fasiclitatorerror"></span>
            <div class="input-group mb-2 p-2" id="ParentStatus">
            <label for="agentpassword " class="input-group-text" >
    <span><i class="bi bi-file-person fs-20" style="font-size: 18px;"></i></span>
</label>

<?php

$sqlfacilitator="SELECT * FROM `agent` WHERE `Type`=0";
$stmtfacilitator=$conn3->prepare($sqlfacilitator);
$stmtfacilitator->execute();
$resultfacilitator=$stmtfacilitator->get_result();

if($resultfacilitator->num_rows>0){
    ?>


<select class="form-select" id="Parentfasilitatirvalue">
                    <option value="">Select Parent facilitator</option>
                   
                    <?php
                    while($rowfacilitator=$resultfacilitator->fetch_assoc()){
                        ?>
                         <option value="<?php echo $rowfacilitator['id'] ?>"><?php echo $rowfacilitator['agent_id']?></option>
              


<?php
                    }


                    ?>

                </select>
    <?php
}


?>
               
            </div>

         <div class="mb-3 p-2">
         <button type="button" class="btn btn-primary btn-sm mt-2" id="registeragent">Submit</button>
        </div>


        </form>

    </div>
    <div class="modal-footer">

    </div>
    </div>
</div>

</div>

<!--agent modal dialoge end  --->
</div>
  </div>
    </div>

    <div class="tab-pane container fade" id="home3">
    <div class="container-fluid">
    <p class="text-center text-capitalize text-dark fs-24 p-2">Advanced search</p>
  
    <div class="mt-1" >

    <!-- <div class="form-floating flex-fill p-2">
        <div class="form form-check-inline">

        <input type="radio" class="form-check-input" name="typeofagents" id="searchFacilitatorAdvance">
        <label for="">Facilitator</label>
        </div>
        <div class="form form-check-inline">
            <input type="radio" class="form-check-input" name="typeofagents" id="searchSallesAgent">
            <label for="">Salles agent</label>
        </div>
    </div> -->
    <div class="form-floating flex-fill p-2">
           <select id="searchresultsstwo" class="form-control">
            <option value="opitons">Option1</option>
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

    <i class="bi bi-person" style="font-size: 25px;"></i><p class="mt-1 p-1">Total registerd users: <span class="badge bg-info" id="totalregistredadvanced">44</span></p>
    </div>
    <div class="container m-2 p-2 shadow-sm flex-fill">


    <i class="bi bi-person-check" style="font-size: 25px;"></i><p class="mt-1 p-1">Total payed users: <span  class="badge bg-success" id="totalpayedadvanced">33</span></p>
    </div>
    <div class="container m-2 p-2 shadow-sm flex-fill">
        
    <i class="bi bi-person-dash" style="font-size: 25px;"></i><p class="mt-1 p-1">Total unpayed user: <span class="badge bg-warning" id="totalunpayedusers">2</span> </p></div>

</div>

<button class="btn btn-primary btn-sm" id="PrintData" type="button">Print</button>
</div>

    </div>
    









    <div class="tab-pane container fade" id="home4">
    <div class="container-fluid">
    <p class="text-center text-capitalize text-dark fs-24 p-2">Payment Request</p>
  
    <div class="mt-1" >
    
        <div class="form-floating flex-fill p-2">
            <input id="startDatePayment" class="form-control" type="date" id="startDate">
            <label for="startDate">Start Date</label>
        </div>
   
        <div class="form-floating flex-fill p-2">
            <input id="endDatePayment" class="form-control" type="date" id="endDate">
            <label for="endDate">End Date</label>
        </div>
   
        <div class="p-2">
            <button type="button" class="btn text-white mt-1" style="background-color:#9932cc;" id="Requestbutton">Find</button>
        </div>
    </div>
</div>


<div class="mt-2" style="display:none;" id="showmewhenrequest">
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


<div class="container mt-3 p-3" id="advancedresultshowPaymentRequest" style="display: none;" >
<!-- 
<p class="text-center">Promocode: <span id="promocodeidss"></span></p> -->

<div class="d-flex  mt-2 p-3">
    <div class="container justify-content-center m-2 p-2 shadow-sm flex-fill">

    <i class="bi bi-person" style="font-size: 25px;"></i><p class="mt-1 p-1">Total registerd users: <span class="badge bg-info" id="totalregistredadvancedPr">44</span></p>
    </div>
    <div class="container m-2 p-2 shadow-sm flex-fill">


    <i class="bi bi-person-check" style="font-size: 25px;"></i><p class="mt-1 p-1">Total payed users: <span  class="badge bg-success" id="totalpayedadvancedPr">33</span></p>
    </div>
    <div class="container m-2 p-2 shadow-sm flex-fill">
        
    <i class="bi bi-person-dash" style="font-size: 25px;"></i><p class="mt-1 p-1">Total unpayed user: <span class="badge bg-warning" id="totalunpayedusersPr">2</span> </p></div>

</div>

<button class="btn btn-primary btn-sm" id="PrintDataPaymentrequest" type="button">Print</button>
</div>

    </div>











</div>
</div>
</div>










</div>


<div class="modal fade" tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true" id="mymodal">

<div class="modal-dialog">
    <div class="modal-content">
        
        <div class="modal-header">
          <p class="modal-title p-2 text-danger text-center" style="font-size: 20px;"><strong>Alert</strong></p>

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




<!---modal for print the payment instrrucation of the agent---->

<div class="modal fade"  tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true" id="modalPrintPaymentRequest">
    <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

    <div class="modal-header">
        <p class="modal-title">Payment Request<span></span></p>
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
<div class="container mt-3 p-3 d-flex flex-fill justify-content-end"><p class="text-capitalize text-dark fs-24"><strong>Day of Print:</strong> <span id="printdatePaymentRequest"></span></p></div>
</div>

</div>

<div class="d-flex justify-content-between mt-2 p-3">

<p>Start Date: <span id="startdateprintPaymentRequest"></span></p>
<p>End Date: <span id="enddateprintPaymentRequest"></span></p>
</div>


<div class="d-flex justify-content-between p-1">
    <!-- <div class="container  m-2 p-2 shadow-sm flex-fill">

    <i class="bi bi-person" style="font-size: 25px;"></i><p class="mt-1 p-1">Tot users :</p>
    <span class="badge bg-info" id="totalregistredprintPR">44</span>
    </div> -->
    <div class="container  p-1 shadow-sm flex-fill">


    <i class="bi bi-person-check" style="font-size: 25px;"></i><p class="mt-1 p-1">Payed users :</p><span  class="badge bg-success" id="totalpayedprintPR">33</span>
    </div>
    <!-- <div class="container m-2 p-1 shadow-sm flex-fill">
        
    <i class="bi bi-person-dash" style="font-size: 25px;"></i><p class="mt-1 p-1">Unpayed user : </p>

    <span class="badge bg-warning" id="totalunpayedprintPR">2</span>
</div> -->

</div>

<div class="container mt-2 p-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type Subscription</th>
                <th>No Subscriber</th>
                <th>Unit Price</th>
                <th>Total Price</th>

            </tr>
            <tbody>
                <tr>
                    <td>monthly</td>
                    <td id="monthlysubscriberPr"></td>
                    <td>290</td>
                    <td id="totalmonthlysubscriberrPr">0000</td>

                </tr>
                <tr>
                    <td>3 monthly</td>
                    <td id="3montlysubscriberrPr"></td>
                    <td>740</td>
                    <td id="total3monthlysubscriberrPr">0000</td>

                </tr>
                <tr>
                    <td>6 monthly</td>
                    <td id="6montlysubscriberrPr"></td>
                    <td>1218</td>
                    <td id="total6monthlysubscriberrPr">0000</td>

                </tr>
                <tr class="bg-light">
                    <td  >Total Sum</td>
                   
                    <td colspan="3" class="bg-success text-center" id="toalsumPr">----</td>

                </tr>
            </tbody>
        </thead>
    </table>
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
<button type="button" class="btn btn-secondary" id="printnowbuttonPR">Print Now</button>
    </div>
    </div>
    </div>
</div>



<!----end of modal date-->
<!--  the modal show -->
  
<!-- Button trigger modal -->

<!-- <script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script> -->


<!-- update agent modal -->

<div class="modal fade" id="updateagentmodal"  tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"  >

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <p class="modal-title text-center" style="font-size: 20px;">Update Agent Form</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
     <p class="text-center text-capitalize  fs-24 text-primary">Fill and Update the agent info</p>

     <input type="text" id="agentid" style="display:none;">
    <form id="updateagentform">

    <span class="text-danger p-1" id="updateagentTypes"></span>

    <div class="input-group d-flex  mb-2 p-2">

    <div class="form-check-inline">
        <input type="radio" value="" class="form-check-input" name="agebtType" id="updatefasilitator">
        <lablel for="fasilitator" class="form-check-label">Facilitator</lablel>
    </div>
    <div class="form-check-inline">
        <input type="radio" value="" class="form-check-input" name="agebtType" id="updatesallesagent">
        <label for="sallesAgent" class="form-check-label">Salles Agent</label>
    </div>
  
        </div>

    <div class="input-group mb-2 p-2">


    <label for="currentParent" class="input-group-text">Current parent</label>
    <input type="text" value=""  id="updateparentname" class="form-control" disabled />
    <input type="text" value=""  id="updateparentId" class="form-control" hidden />

    </div>
    <span class="text-danger p-1"  id="updatepromocodeerror"></span>
        <div class="input-group mb-2 p-2">
            <label for="agentname" class="input-group-text"><span><i class="bi bi-upc-scan fs-20" style="font-size: 18px;"></i></span></label>
                <input type="text" name="agentname" id="updateagentpromocodeadding" class="form-control agentclass" placeholder="Enter the agent promo code" required>
           
            </div>
            <span class="text-danger p-1" id="updateagentnameerror"></span>
            <div class="input-group mb-2 p-2">
            <label for="agentname" class="input-group-text"><span><i class="bi bi-person-fill fs-20" style="font-size: 18px;"></i></span></label>
                <input type="text" name="agentname" id="updateagentname" class="form-control" placeholder="Enter the agent name" required>
             
            </div>

           

            <span class="text-danger p-1" id="updatephoneerror"></span>
            <div class="input-group mb-2 p-2">

<label for="agentpassword " class="input-group-text" >
    <span><i class="bi bi-phone-fill fs-20" style="font-size: 18px;"></i></span>
</label>
            <input type="number" name="agentphone" id="updateagentphoneno" class="form-control myclass" placeholder="Enter the agent phone number" required>
          
            </div>



              <span class="text-danger p-1" id="updatepassworderror"></span>
            <div class="input-group mb-2 p-2">

<label for="agentpassword " class="input-group-text" >
    <span><i class="bi bi-key-fill fs-20" style="font-size: 18px;"></i></span>
</label>
            <input type="password" name="agentpassword" id="updateagentpassword" class="form-control passwordclassupdate" placeholder="Enter the new password" required>


            <!-- <div class="input-group-append"> -->
                <span class="input-group-text">
                    <i class="bi bi-eye" id="showpassword" style="font-size: 18px;cursor: pointer;"></i>
                </span>
            <!-- </div> -->
          
            </div>

            <span class="text-danger p-1" id="confirmupdatepassworderror"></span>

            <div class="input-group mb-2 p-2">

<label for="agentpassword " class="input-group-text" >
    <span><i class="bi bi-clipboard-check" style="font-size: 18px;"></i></span>
</label>
            <input type="password" name="agentpassword" id="Confirmupdateagentpassword" class="form-control passwordclassconfirm" placeholder="Confirm the password again" required>


            <span class="input-group-text">
                    <i class="bi bi-eye" id="showconfirmpassword" style="font-size: 18px;cursor: pointer;"></i>
                    </span>
          
            </div>

            <span class="text-danger p-1" id="updatefasiclitatorerror"></span>
            <div class="input-group mb-2 p-2" id="updateparentStatus">
                <label for="agentname" name="" class="input-group-text"><span><i class="bi bi-person-fill fs-20" style="font-size: 18px;"></i></span></label>
                <!-- <select class="form-select" id="selectUpdatePrent">
                    <option value="">Select Facilitator</option>
                    <option value="1">Facilitator 1</option>
                    <option value="2">Facilitator 2</option>
                </select> -->

                <?php

$sqlfacilitatorUpdated="SELECT * FROM `agent` WHERE `Type`=0";
$stmtfacilitatorUpdate=$conn3->prepare($sqlfacilitatorUpdated);
$stmtfacilitatorUpdate->execute();
$resultfacilitatorUpdate=$stmtfacilitatorUpdate->get_result();

if($resultfacilitatorUpdate->num_rows>0){
    ?>


<select class="form-select" id="selectUpdatePrent">
                    <option value="">Select UpdateParent facilitator</option>
                   
                    <?php
                    while($rowfacilitatorUpdate=$resultfacilitatorUpdate->fetch_assoc()){
                        ?>
                         <option value="<?php echo $rowfacilitatorUpdate['id'] ?>"><?php echo $rowfacilitatorUpdate['agent_id']?></option>
              


<?php
                    }


                    ?>

                </select>
    <?php
}


?>
            </div>


          

         <div class="mb-3 p-2">
         <button type="button" class="btn  btn mt-2" style="background-color: #9932cc;color:white;" id="updateAgent">Update</button>
        </div>


        </form>

        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
</div>

<!-- end of update agent modal -->

   

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

        //===================create fucntion to pupulate tables for data retrival


        function PopulateTable(data){

            var tablebody=document.querySelector('#agentstable tbody');


            data.forEach( function(rowData){


                var row=document.createElement('tr');
var agentCodeUrl = encodeURIComponent(rowData.agentcode);

                row.innerHTML=`<td>${rowData.agentcode}</td>
<td>${rowData.agentname}</td>
<td ><input type="hidden" value="${rowData.created_at}"></td>

<td>${rowData.status==0?'<span class="badge bg-warning">Deactive</span>':'<span class="badge bg-primary">Active</span>'}</td>
<td ><span class="copyable-link">https://etemari.net/login/signup.php?id=${agentCodeUrl}</span>    <span class="btn btn-sm border-1 border-dark mt-1" id="copylinkbtn">C</span> </td>
<td>${rowData.Type==0?'<span class="AgentType-fs">facilitator</span>':'<span class="AgentType-sa">salles</span>'}</td>
<td>${rowData.parent_id}</td>
<td><button type="button" id="updateagentbutton"

data-promocode="${rowData.agentcode}"
data-agentType="${rowData.Type}"
data-parentid="${rowData.parent_id}"
data-parebtUniqueId="${rowData.uniqueid}"
data-username="${rowData.agentname}" data-phoneno="${rowData.phone_no}" data-id="${rowData.id}" class="btn btn-outline-info btn-sm"><span></span>Update</button></td>
<td>


<button type="button" class="btn btn-outline-success btn-sm" data-userid="${rowData.id}" id="activeagentbutton">Activate</button>
<button type="button" class="btn btn-outline-danger btn-sm" data-userid="${rowData.id}" id="deactiveagentbutton">Deactivate</button>



</td>`;


tablebody.appendChild(row);


            });

            //event listener
            tablebody.addEventListener('click',function(event){


//===========if the active agent is clicked============
                if(event.target.id=='activeagentbutton'){

                    var agentid=event.target.getAttribute('data-userid');

                    console.log('the agent id is '+agentid);

                    $.ajax({

                        url:'activateagent.php',
                        method:'POST',
                        data:{agentid:agentid},
                        success:function(response){
                            console.log('the agent is activated');
                            

                            event.target.closest('tr').querySelector('td:nth-child(4)').innerHTML='<span class="badge bg-primary">Active</span>';
                            //let update the status column;
                        },
                        error:function(xhr,status,error){
                            console.log('error in activating the agent'+error);
                        }
                    });
                   
                    console.log('the active agent button is clicked');
                }


//=========================if the copu clip bord button is cliked================



if(event.target.id=='copylinkbtn'){
    console.log('the copy link button is clicked');
    var link=event.target.closest('td').querySelector('.copyable-link').textContent;
    console.log('the link is '+link);
    var dummy=document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value=link;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    event.target.textContent='Copied';
    setTimeout(function(){
        event.target.textContent='Link';
    },2000);


    
}

                //===================isf the deactive agent button is clicked==========


if(event.target.id=='deactiveagentbutton'){
 
 //deactive button is clicked

 
 var agentid=event.target.getAttribute('data-userid');


 Swal.fire({
    icon: 'warning',
    title: 'Are you sure?',
    text: 'You want to deactivate this agent!',
    height:'200px',
    width:'400px',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, deactivate it!'
  }).then((result) => {
    if (result.isConfirmed) {
        console.log('the agent id is '+agentid);
 console.log('deactive button is clciekd');


 $.ajax({
    url:'deactiveagent.php',
    method:'POST',
    data:{agentid:agentid},
    success:function(response){

        console.log('the agent is deactivated');
        event.target.closest('tr').querySelector('td:nth-child(4)').innerHTML='<span class="badge bg-warning">Deactivate</span>';

    },
    error:function(xhr,status,error){

    }
 });

    }
    else {

    }
 });
 
}

//============end of deactive button is clicked=


//==============when updte button is clicked=====


if(event.target.id=='updateagentbutton'){

    console.log('update agent button is cliekd');


    var phone_no=event.target.getAttribute('data-phoneno');

    var agentpromocode=event.target.getAttribute('data-promocode');
    var agentname=event.target.getAttribute('data-username');

    var agentType=event.target.getAttribute('data-agentType');

    var parent_name=event.target.getAttribute('data-parentid');

    $('#updateagentphoneno').val(event.target.getAttribute('data-phoneno'));

    $('#updateagentpromocodeadding').val(event.target.getAttribute('data-promocode'));

    $('#updateagentname').val(event.target.getAttribute('data-username'));

    $('#agentid').val(event.target.getAttribute('data-id'));

    if(agentType==0){
        $('#updatefasilitator').prop('checked',true);
         $('#updateparentStatus').hide();
         $('#updatefasiclitatorerror').text('');
    }
    else{
        $('#updatesallesagent').prop('checked',true);
         $('#updateparentStatus').show();
    }

$('#updateparentname').val(event.target.getAttribute('data-parentid'));

$('#updateparentId').val(event.target.getAttribute('data-parebtUniqueId'));
    $('#updateagentmodal').modal('show');

  
}
            });




        }

        //===================end of create fucntion to pupulate tables for data retrival

//=================when update button cliked and when the admin want to update the agent type is facilitator or salles agent

$('#updatefasilitator').on('click',function(){

    console.log('the fasicilator is selected');
    $('#updateparentStatus').hide();
    $('#updatefasiclitatorerror').text('');
});

$('#updatesallesagent').on('click',function(){

    $('#updateparentStatus').show();

});


        //======when the eye icon for password is clciked======

        $('#showpassword').on('click',function(){

console.log('the password is clicked');

const passwordInput=$('#updateagentpassword');

const type=passwordInput.attr('type')=== 'password'?'text':'password';

passwordInput.attr('type',type);


$(this).toggleClass('bi-eye bi-eye-slash');

});




///================when the show passowrd of confiramtion is slicked===



$('#showconfirmpassword').on('click',function(){



    console.log('the confirmation button is clciked');


    const confirmationInput=$('#Confirmupdateagentpassword');
    const type=confirmationInput.attr('type')=== 'password'?'text':'password';
    confirmationInput.attr('type',type);
    $(this).toggleClass('bi-eye bi-eye-slash');

});
function fetchagentTablesData(){
    $.ajax({

url:'fetchagent.php',
method:'GET',
dataType:'json',
success:function(response){
  

    PopulateTable(response);
    // Destroy existing DataTable instance before reinitializing

   
    if ($.fn.DataTable.isDataTable('#agentstable')) {
                $('#agentstable').DataTable().destroy();
            }

            $('#agentstable').DataTable({
                "order": [[2, "desc"]] 
                
            });// Order by the 3rd column (index 2) in descending order

    console.log('the response data is'+ JSON.stringify(response));
},
error:function(xhr,status,error){
    console.log('errro in fething the data is '+error);
}
});
}
fetchagentTablesData();
/**
 * agents table full infomation
 */

 $('#addagent').on('click',function(){



$('#addagentmodal').modal('show');


    $('#addagentmodal').modal({
        backdrop:'static',
        keyboard:false
    });

 });


 //=========================show the fasicilator when the salles agent is seleted=======================//
 $('#fasilitator').on('click',function(){

    $('#ParentStatus').hide();
    $('#fasiclitatorerror').text('');

 });

 //========show the select input option when the salles agent is cliked=========//


 $('#salledagent').on('click',function(){


    $('#ParentStatus').show();
 });



 /** ===============data submitting when the #registeragent button is clicked= */

 $('#registeragent').on('click',function(){

var promocode=$('#agentpromocodeadding').val();
var agentname=$('#agentname').val().trim();

var password=$('#agentpassword').val();

var phone=$('#agentphoneno').val();

var fasicilitor=$('#fasilitator').prop('checked');

var sallesAgent=$('#salledagent').prop('checked');


var parentStatus=$('#ParentStatus');

var selectOptionFasilitator=$('#Parentfasilitatirvalue').val();


var Type=0;


//=====check the agent type is selected or not
if(!fasicilitor && !sallesAgent){
$('#agentTypes').text('Please select the agent type');


return;
}
else{
    $('#agentTypes').text('');
if(fasicilitor){
    console.log(`the fasicilitor is selected${Type}`);
    parentStatus.hide();
    Type=0;
}
else{
    Type=1;
    console.log(`the sales agent is selected  ${Type}`);
    parentStatus.show();
  
if(selectOptionFasilitator.trim() ===''){
    $('#fasiclitatorerror').text('Please select the fasicilator');
    return;
}
else{
    $('#fasiclitatorerror').text('');
}

}
    
}

if(promocode.trim()==''){
    $('#promocodeerror').text('Please enter the promo code');
}
else{
    
    var promocodeexist=true;
    // $('#promocodeerror').text('');
    //=======let check the agent code that means promocode is already exitst or not

    $.ajax({

        url:'checkagentcode.php',
        method:'POST',
        data:{agentcode:promocode},
        success:function(response){
            console.log('the promo code is '+response);

            if(response.trim()=='true'){
                console.log('the promo code is already exitst');
                $('#promocodeerror').text('This promo code is already exitst');

                promocodeexist=true;
            }
            else if(response.trim()=='false'){
                console.log('the promo code is not exitst');
                $('#promocodeerror').text('');
             
                if(passwordValid && passwordLength && agentname.trim()!='' && promocode.trim()!='' && phone.trim()!='' && startsWith09Pattern.test(phone) && phonepattern.test(phone) &&  (fasicilitor ||(sallesAgent && selectOptionFasilitator.trim() != '') ))  {


console.log('uploaded is start');
$.ajax({
    url:'registeragent.php',
    method:'POST',
    data:{agentpromocode:promocode, agentname:agentname, agentpassword: password, phone:phone, agentType:Type,parentFasilitator:selectOptionFasilitator},
    success:function(response){
        console.log('the data is successfully submitted');
        $('#addagentmodal').modal('hide');
       

      location.reload();

// fetchagentTablesData();



// $('#agentstable').DataTable();
        // fetchagentTablesData();
     
        // fetchagentTablesData();
    },
    error:function(xhr,status,error){


        console.log('error in submitting the data'+error);
    }
});
}

            }
        },
        error:function(xhr,status,error){


            console.log('error in checking the promo code'+error);
        }
    });



}
if(agentname.trim()==''){
    $('#agentnameerror').text('Please enter the agent name');
    
}
else{
    $('#agentnameerror').text('');
}

if(password.trim()==''){
    $('#passworderror').text('Please enter the agent password');
}
else{
    var passwordValid = /^(?=.*[a-zA-Z])(?=.*[0-9])/.test(password);

var passwordLength=password.length>4;

if(!passwordValid){
$('#passworderror').text('Password must contain at least one letter and one number');

$('.passwordclass').css('border-color','red');
}
else if(!passwordLength){
    $('#passworderror').text('Password must be at least 5 characters long');
$('.passwordclass').css('border-color','red');

}
else{
    $('#passworderror').text('');
$('.passwordclass').css('border-color','green');

}
}



if(phone.trim()==''){
    $('#phoneerror').text('Please enter the agent phone number');
}
else{
    var startsWith09Pattern = /^09/;

var phonepattern=/^\d{10}$/;

if(!startsWith09Pattern.test(phone)){
    $('#phoneerror').text('Phone number must start with 09');

    //==let show red border to the phone input field==
    $('.myclass').css('border-color','red');
}
else if(!phonepattern.test(phone)){
    $('#phoneerror').text('Phone number must be 10 digits long');
    $('.myclass').css('border-color','red');
}
else{
    $('#phoneerror').text('');
    // $('.myclass').css('border-color','green');
    $('.myclass').css('border','1px solid green');
}

   
   
}







 });


//===========update agent button is clicked=================


$('#updateAgent').on('click',function(){
console.log('update agent button is clicked');



//============password validation=

var promocode=$('#updateagentpromocodeadding').val();
var agentname=$('#updateagentname').val().trim();
var phone=$('#updateagentphoneno').val();   
var password=$('#updateagentpassword').val();
var confirmpassword=$('#Confirmupdateagentpassword').val();

var agentid=$('#agentid').val();

var fasilitator=$('#updatefasilitator').prop('checked');
var sallesAgent=$('#updatesallesagent').prop('checked');

var parentStatusSelected=$('#selectUpdatePrent').val();

var UpdatedParentName=$('#updateparentname').val();

var currentParentId=$('#updateparentId').val();

var AgentType=0;

if(!fasilitator && !sallesAgent){
    $('#updateagentTypes').text('Please select the agent type');
    return;
}
else{
    $('#updateagentTypes').text('');

    if(fasilitator){
        AgentType=0;
        console.log(`the agent selected facilitator is ${AgentType}`);
    }
    else{
        AgentType=1;

        if(UpdatedParentName.trim() == 'Etemari' && parentStatusSelected.trim() == '' ){
            $('#updatefasiclitatorerror').text('Please select the fasicilator');
            return;


        }
        else{
            $('#updatefasiclitatorerror').text('');
        }
        console.log(`the agent selected is salles agent ${AgentType}`);
    }
}

if(promocode.trim()==''){       
$('#updatepromocodeerror').text('Please enter the promo code');

}
else{

var promocodeexist=false;
    $.ajax({

url:'checkagentcodepromo.php',
method:'POST',
data:{agentcode:promocode, agentid:agentid},
success:function(response){


        console.log('the promo code is '+response);
        if(response.trim()=='true'){

        $('#updatepromocodeerror').text('This promo code is already exist');
        promocodeexist=true;

        }
        else if(response.trim()=='false'){
        $('#updatepromocodeerror').text('');
        promocodeexist=false;
        }
},
error:function(xhr,status,error){

    console.log('the error in checking the promo code'+error);

}
});
  
}


if(agentname.trim()==''){   

    $('#updateagentnameerror').text('Please enter the agent name');

}
else{
    $('#updateagentnameerror').text('');
}



if(phone.trim()==''){
    $('#updatephoneerror').text('Please enter the agent phone number');
}
else{

    $('#updatephoneerror').val('');
}



if(password.trim() != ''){
    var passwordValid = /^(?=.*[a-zA-Z])(?=.*[0-9])/.test(password);

var passwordLength=password.length>4;



if(!passwordValid){
    $('#updatepassworderror').text('Password must contain at least one letter and one number');
    $('.passwordclassupdate').css('border-color','red');
}
else if(!passwordLength){
    $('#updatepassworderror').text('Password must be at least 5 characters long');
    $('.passwordclassupdate').css('border-color','red');

}
else{
    $('#updatepassworderror').text('');
    $('.passwordclassupdate').css('border-color','green');

if(confirmpassword.trim()== ''){

    $('#confirmupdatepassworderror').text('Please confirm the password');
    $('.passwordclassconfirm').css('border-color','red');


}
else if(confirmpassword.trim() != password.trim()){
    $('#confirmupdatepassworderror').text('Passwords do not match');
    $('.passwordclassconfirm').css('border-color','red');
}
else{
    $('#confirmupdatepassworderror').text('');
    $('.passwordclassconfirm').css('border-color','green');
}

}

}


if(password.trim() === '' && agentname.trim()!= '' && promocode.trim()!= '' && phone.trim()!= '' && promocodeexist== false && (fasilitator || ((sallesAgent && UpdatedParentName != 'Etemari' ) ||( sallesAgent && parentStatusSelected.trim() != ''))) ){

    console.log('the data is submitted with PopulateTable clicked with out password');

    console.log(`the current parent _id is ${currentParentId},${parentStatusSelected},${AgentType}`);

    // return;

    $.ajax({

url:'updateagent.php',
method:'POST',
data:{agentid:agentid, agentpromocode:promocode,agentname:agentname, phone:phone, password:password, agentType:AgentType, parentStatusSelectedd:parentStatusSelected, currentParent:currentParentId},
success:function(response){
    console.log('the data is successfully submitted and updated the agent'+response);

    $('#updateagentmodal').modal('hide');
    location.reload();

},
error:function(xhr,status,error){

    console.log('error in updated the data'+error);


}

});
}

else if(password.trim() != '' && passwordValid && password.trim()=== confirmpassword.trim()  && agentname.trim() != '' && promocode.trim() != '' && phone.trim() != '' && promocodeexist==false && (fasilitator || ((sallesAgent && UpdatedParentName != 'Etemari' ) ||( sallesAgent && parentStatusSelected.trim() != '')))){

    
    console.log('the data is submitted with PopulateTable clicked with password');

    $.ajax({

url:'updateagent.php',
method:'POST',
data:{agentid:agentid, agentpromocode:promocode,agentname:agentname, phone:phone, password:password,agentType:AgentType,parentStatusSelectedd:parentStatusSelected,currentParent:currentParentId},
success:function(response){
    console.log('the data is successfully submitted and updated the agent'+response);

    $('#updateagentmodal').modal('hide');
    location.reload();

},
error:function(xhr,status,error){

    console.log('error in updated the data'+error);


}

});

}







//==============end of password validation===============





});



//=============end of data agent update================















 //=============active agent button clciked
 $('#activeagentbutton').on('click',function(){


console.log('the active agnet button is clicked');
 });

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


function selelectOptionSallesAgent(SelectionOptionId){
    $.ajax({
    url:'searchpromocode.php',
    method:'POST',
    data:{},
    success:function(response){
        console.log('the value is successed');

        const SearchResults=JSON.stringify(response);
        const Searchbox=$(`#${SelectionOptionId}`);

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


}

selelectOptionSallesAgent('searchresultss');



//======================append the facilitator Code for selection Option=====
function selectFacilitatorSelectOption(SelectionOptionId){

    $.ajax({
    url:'totalFacilitator.php',
    method:'POST',
    data:{},
    success:function(response){
        const SearchResults=JSON.stringify(response);
        // const response=JSON.stringify(response);
console.log(response);


        const SearchBoxSecond=$(`#${SelectionOptionId}`);

        SearchBoxSecond.empty();
        SearchBoxSecond.append('<option id="searchhere" value="">Select Facilitator</option>');

        if(response.length >0){

            response.forEach(result=>{
                // SearchBoxSecond.append(`<option value="${result}">${result}</option>`);
                SearchBoxSecond.append(`<option  value="${result}">${result}</option>`);
            });
            SearchBoxSecond.show();
        }
        else{
            SearchBoxSecond.hidden();
        }
        console.log('the response data is '+response);
    },

    error:function(xhr,status,error){
        console.log('the error ocurred is'+error);
    }
});

}


selectFacilitatorSelectOption('searchFacilitatorCode');
//====================================when facilitator searchFacilitatorCode option is cliked==============//

$('#searchFacilitatorCode').on('change',function(){
    $('#searchresultss').val('');
    $('#barGraph').hide();
$('#barGraphSecond').show();


    $(this).find('option:contains("Select Facilitator")').prop('disabled',true);

    $('#selectedPromocode').html($(this).val());
    $('#selectedPromocode').css('background-color','#198754');
    $('#selectedPromocode').css('color','white');

    var selectedFacilitatorCode=$(this).val();
    console.log('the selected facilitator code is '+selectedFacilitatorCode);
    UpdateOnlineusers(selectedFacilitatorCode,'false');
    BargraphsystemSecond(selectedFacilitatorCode,'false');
});




















/****
 * 
 * ==========================================belowe is function of update online user
 * update onlein users
 * bar graph system
 */

 
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
        data: { promoid: promoid,indivisualValue:isIndivisual },
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

let myChart = null; 
function BargraphsystemSecond(promoid,indivisual) {

console.log('the promoid is '+promoid);
const ctx = document.getElementById('barGraphSecond').getContext('2d');

// Fetch data based on promoid
const url = promoid ? `weeklypromoid.php?promoid=${promoid}&indivisualValue=${indivisual}` : 'weekly.php';

if (myChart) {
        myChart.destroy();
        myChart=null;
    }

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
// //when promo code is clicked
// $('#promocode').on('click',function(){

//     console.log('promo code is cliecked........................');
// });

//when replay button click



/**
 * slect otpion when chnaged
 */



/**@abstract
 * when delete button click to delate the message
 */




 /**
  * method when the file uplaod button click
  */


  // uplaod file from admin int o user

/**
 * method when send button clcik to send message
 */

 








/**
 * method fot updating the status with ajax request
 */












 //end of ajax ofor status updated






    });

var catagoryids=[];





  /**
     * ajax for updating the status for reject button
     */



$(document).ready(function(){



    // Copy link to clipboard when button is clicked


    $('#searchresultss').on('change',function(){
        $('#searchFacilitatorCode').val('');

        $('#barGraph').show();
        $('#barGraphSecond').hide();
 $(this).find('option:contains("Select Promocode")').prop('disabled',true);

var selectedPromoCode=$(this).val();

console.log('the selected promocode is '+selectedPromoCode);
$('#selectedPromocode').html(selectedPromoCode);
$('#selectedPromocode').css('background-color','#0d6efd');
$('#selectedPromocode').css('color','white');

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
        data: { promoid: promoid,indivisualValue:isIndivisual },
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


UpdateOnlineusers();//update in 1000 microsecods



//=====line graph for weekly graph

let myChart = null; // Declare this variable outside the function to hold the chart instance

function Bargraphsystem(promoid,indivisual) {

    console.log('the promoid is '+promoid);
    const ctx = document.getElementById('barGraph').getContext('2d');

    // Fetch data based on promoid
    const url = promoid ? `weeklypromoid.php?promoid=${promoid}&indivisualValue=${indivisual}` : 'weekly.php';
    // if (myChart) {
    //     myChart.destroy();
    // }
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

Bargraphsystem(); // Initialize the function

/**
 * method for showing the facilitator or salles agent in option box when advance search is selected
 * 
 */

 $('#searchFacilitatorAdvance').on('click',function(){

    selectFacilitatorSelectOption('searchresultsstwoFacilitator');

 });

 $('#searchSallesAgent').on('click',function(){


    selelectOptionSallesAgent('searchresultsstwoFacilitator');
 });


 function selectFacilitatorSelectOption(SelectionOptionId){

$.ajax({
url:'totalFacilitator.php',
method:'POST',
data:{},
success:function(response){
    const SearchResults=JSON.stringify(response);
    // const response=JSON.stringify(response);
console.log(response);


    const SearchBoxSecond=$(`#${SelectionOptionId}`);

    SearchBoxSecond.empty();
    SearchBoxSecond.append('<option id="searchhere" value="">Select Facilitator</option>');

    if(response.length >0){

        response.forEach(result=>{
            // SearchBoxSecond.append(`<option value="${result}">${result}</option>`);
            SearchBoxSecond.append(`<option  value="${result}">${result}</option>`);
        });
        SearchBoxSecond.show();
    }
    else{
        SearchBoxSecond.hidden();
    }
    console.log('the response data is '+response);
},

error:function(xhr,status,error){
    console.log('the error ocurred is'+error);
}
});

}






function selelectOptionSallesAgent(SelectionOptionId){
    $.ajax({
    url:'searchpromocode.php',
    method:'POST',
    data:{},
    success:function(response){
        console.log('the value is successed');

        const SearchResults=JSON.stringify(response);
        const Searchbox=$(`#${SelectionOptionId}`);

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


}

/**
 *  method and jquery funciton when find button is clciked
 * =============================find button is cliekd============
 */

 $('#findButton').on('click',function(){
    $('#advancedresultshow').hide();

    // var facilitator=$('#searchFacilitatorAdvance').prop('checked');
    // var sallesAgent=$('#searchSallesAgent').prop('checked');
    // // var sallesAgent=$('#')

    // if(!facilitator && !sallesAgent){
    //     $('#errormessage').text('Please select Agent type');
    //     $('#mymodal').modal('show');
    //     return;

    // }
var promoid=$('#searchresultsstwo').val();
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

    console.log('the response data is '+response);
    $('#showmewhen').hide();
    $('#advancedresultshow').show();
    $('#promocodeidss').text(promoid);



    var data=JSON.parse(response);

    var totalunpayedusers=data.totalregisterpromocodeuser-data.totalpayedusers;
    $('#totalregistredadvanced').text(data.totalenteruser);
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




 /***
  * 
  * method when the payment request button is clicked
  */



  
 $('#Requestbutton').on('click',function(){
    $('#advancedresultshowPaymentRequest').hide();
// var promoid=$('#searchresultsstwo').val();
var startDatePr=$('#startDatePayment').val();

var endDatePr=$('#endDatePayment').val();
// if(promoid=== ''){
//     $('#errormessage').text('Promo code can not be null');
//   $('#mymodal').modal('show');
//     return;

// }


if(startDatePr === ''){
    $('#errormessage').text('Start date is null');
    $('#mymodal').modal('show');
   
    return;
}

if(endDatePr === ''){
    $('#errormessage').text('End date is null');
    $('#mymodal').modal('show');
   
    return;
}


if(startDatePr > endDatePr){
    $('#errormessage').text('the Start date can not be greater than End date');
    $('#mymodal').modal('show');
   
    return;
}
startDatePr=new Date(startDatePr);

endDatePr=new Date(endDatePr);

var datenow=new Date();



if(startDatePr > datenow || endDatePr > datenow){
    $('#errormessage').text('the Start date or End date can not be greter than todays date');
    $('#mymodal').modal('show');
  
    return;
}

// console.log('the promocode is'+promoid);
console.log('the start date'+startDatePr);
console.log('the end date'+endDatePr);
// console.log('the promocode is'+promoid);

const startDateFormatpr = new Date(startDatePr).toISOString().slice(0, 19).replace('T', ' ');
// const endDateFormat = new Date(endDate).toISOString().slice(0, 19).replace('T', ' ');
const endDateFullDay = new Date(endDatePr).setHours(23, 59, 59, 999); // Adjust end date to include full day
const endDateFormatpr = new Date(endDateFullDay).toISOString().slice(0, 19).replace('T', ' ');

//let request ajax request
$('#showmewhenrequest').show();

setTimeout(function(){

    
    $.ajax({

url:'payementrequest.php',
method:'POST',
data:{startDate:startDateFormatpr,endDate:endDateFormatpr},
success:function(response){
    $('#showmewhenrequest').hide();
    $('#advancedresultshowPaymentRequest').show();
    // $('#promocodeidss').text(promoid);

    var data=JSON.parse(response);

    var totalunpayedusers=data.totalenteruser-data.totalpayedusers;
    $('#totalregistredadvancedPr').text(data.totalenteruser);
    $('#totalpayedadvancedPr').text(data.totalpayedusers);
    $('#totalunpayedusersPr').text(totalunpayedusers);
    console.log('the response is '+response);


    //=====when print  button is clicked=====

    $('#PrintDataPaymentrequest').on('click',function(){

        //show modal button for printing

        $('#modalPrintPaymentRequest').modal("show");
        const options={year:'numeric', month:'long',day:'numeric'};
        const FormatedDate=new Date().toLocaleDateString(undefined,options);

        $('#printdatePaymentRequest').text(FormatedDate);
        // $('#printpromocodePr').text(promoid);
        const startFormateddateprint=startDatePr.toLocaleDateString(undefined,options);
        const endFormateddateprint=endDatePr.toLocaleDateString(undefined,options);
        $('#startdateprintPaymentRequest').text(startFormateddateprint);
        $('#enddateprintPaymentRequest').text(endFormateddateprint);
        $('#totalregistredprintPR').text(data.totalenteruser);
        $('#totalpayedprintPR').text(data.totalpayedusers);
        $('#totalunpayedprintPR').text(totalunpayedusers);
        


        const monthlysubscriber=data.monthlysubscriber;
        const threemonthlysubscriber=data.thiredmonthlysubscriber;
        const Sixmonthlysubscriber=data.Sixmonthlysubscriber;

        $('#monthlysubscriberPr').text(monthlysubscriber);

        $('#3montlysubscriberrPr').text(threemonthlysubscriber);
        $('#6montlysubscriberrPr').text(Sixmonthlysubscriber);

        const TotalmonthlySubs=monthlysubscriber*290;
        const Total3monthlySubs=threemonthlysubscriber*740;
        const Total6monthlySubs=Sixmonthlysubscriber*1218;


        const Totalsum=TotalmonthlySubs+Total3monthlySubs+Total6monthlySubs;

        $('#totalmonthlysubscriberrPr').text(TotalmonthlySubs);
        $('#total3monthlysubscriberrPr').text(Total3monthlySubs);
        $('#total6monthlysubscriberrPr').text(Total6monthlySubs);
        $('#toalsumPr').text(Totalsum);


        //============when print now button is clciked=====
       // Add a click event listener to the "Print Now" button
$('#printnowbuttonPR').on('click', function() {
    // Create a new window for printing
    var printWindow = window.open('', '_blank');

    // Get the content of the modal body
    var modalBodyContent = $('#modalPrintPaymentRequest .modal-body').html();

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


//====grade report values for each grade
$.ajax({
    url:'gradereport/grade9.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#grade9').text(response);

    },error:function(xhr,status,error){
        console.log('error in geting the data for grade 10');
    }
});



//=======grade 10 report values for each grade
$.ajax({
    url:'gradereport/grade10.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#grade10').text(response);

    },error:function(xhr,status,error){
        console.log('error in geting the data for grade 10');
    }
});


//=======grade 11  Natural report values for each grade
$.ajax({
    url:'gradereport/grade11N.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#grade11N').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 11');
        }
});

//=======grade 11  SOCIAL report values for each grade
$.ajax({
    url:'gradereport/grade11S.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#grade11S').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 11');
        }
});


//=======grade 12 Natural report values for each grade
$.ajax({
    url:'gradereport/grade12N.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#grade12N').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 12');
        }
});



//=======grade 12 Social report values for each grade
$.ajax({
    url:'gradereport/grade12S.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#grade12S').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 12');
        }
});



//=============esslce natural esslceNatural

$.ajax({
    url:'gradereport/esslcenatural.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#esslceNatural').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 12');
        }
});


//==============esslce social esslceSocial

$.ajax({
    url:'gradereport/esslcesocial.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#esslceSocial').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 12');
        }
});

//==============monthly sibscriber 

$.ajax({
    url:'gradereport/monthlysubscribe.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#monthysubscirbe').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 12');
        }
});

//==============3 monthly subsciber

$.ajax({
    url:'gradereport/3monthsubscriber.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#3monthsubscriber').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 12');
        }
});



//==============6monthly subsciber

$.ajax({
    url:'gradereport/6monthsubscriber.php',
    method:'GET',
    data:{},
    success:function(response){
        console.log('the value is successed');

        $('#6monthsubscriber').text(response);

        },error:function(xhr,status,error){
        console.log('error in geting the data for grade 12');
        }
});

 });




</script>
</html>