<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page for agents</title>

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
        /* background-color: #f2f2f2; */
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 25px;
    }
    .inputround{
        border-radius: 7px;
    }
    .inputround:focus{
        box-shadow: 0 0 5px #000000;
    }
    .submitbutton{

        overflow: none;
        border: none;
    }
    .submitbutton:hover{
        cursor: pointer;
        background-color: red;
        color: white;
        border-radius: 15px;
        box-shadow: inset 0px 0px 3px 0px;
    }
</style>
</head>
<body class="bg-light">

<!-- lets desgin amazing and interactive login page -->
 

<div class="justify-content-center align-item-center">
    
<p>Login here..</p>
<div class="container border p-4 bg-white">

<div class="container justify-content-center align-item-center ml-5">
            <img class="rounded-circle"  width="140" height="90" src="./logo.webp"/>
</div>

    <div class="container mt-2">
        <form action="">

        <span class="text-danger mb-3" id="totalerror"></span>
            <div class="input-group mt-2 mb-1 p-1">
<button type="button" class="btn btn-success input-group-text inputround">
<span><i class="bi bi-person-circle"></i></span></button>
                <input type="text" class="form-control p-2 inputround errorusername" id="username" name="username" placeholder="Enter your username">
              
            <!-- #regio-->           </div>
             <span class="text-danger mb-3" id="usernameerror"></span>

            <div class="input-group mt-2 mb-2 p-1">
            <button type="button" class="btn btn-secondary input-group-text inputround">
            <span><i class="bi bi-key-fill"></i></span></button>
                <input type="password" class="form-control p-2 inputround" id="password" name="password" placeholder="Enter your password">
               

                <span class="input-group-text inputround">
                    <i class="bi bi-eye-fill" id="passwordhideshow"></i>
                </span>
            <!-- #regio-->           </div>

            <span class="text-danger mb-3" id="passworderror"></span>

           <div class="justify-content-center  align-item-center mt-4  mb-3 submitbutton" id="loginbutton" style="background-color: #9932cc;color:white">
           <p class="text-center p-1">Login</p>
           </div>
        </form>
    </div>
</div>
</div>
    
</body>

<script>


$(document).ready(function(){


    //===let create toggle effenct fo passwrd box-shadow



    $('#passwordhideshow').on('click',function(){



        console.log('password hide show button is clicked');

        const passwordInput=$('#password');


        const type=passwordInput.attr('type')==='password'?'text':'password';


        passwordInput.attr('type',type);

        $(this).toggleClass('bi-eye-fill bi-eye-slash')
        
    });


$('#loginbutton').on('click',function(){


    console.log('login button is clicked');

    var username=$('#username').val();

    var password=$('#password').val();

    if(username.trim() ==''){

        $('#usernameerror').text('Please enter your username');

       $('.errorusername').css('border-color','red');
    }
    else{
        $('#usernameerror').text('');
        $('.errorusername').css('border-color','green');
    }



    if(password.trim()==''){
        $('#passworderror').text('Please enter your password');
        $('#password').css('border-color','red');
    }
    else{
        $('#passworderror').text('');
        $('#password').css('border-color','green');
    }



    if(username.trim() != '' && password.trim() != ''){


        $.ajax({

            url:'loginchecker.php',
            method:'POST',
            data:{username:username, password:password},
            success:function(response){

                console.log('the response data is '+response);


                if(response.trim()==='Invalid password'){

                    $('#totalerror').text('Invalid password');

                }
                else if(response.trim() ==='Invalid username or password'){

                    $('#totalerror').text('Invalid username or password');

                }
                else if(response.trim() ==='Your account is inactive or suspended'){

                    $('#totalerror').text('Your account is inactive or suspended contact manager for more information');
                }
                else if(response.trim()==='Facilitator login successfully') {
                    $('#totalerror').text('');
                    window.location.href='indexfacilitator.php';
                }
                else{
                    $('#totalerror').text('');
                    window.location.href='indexagent.php';

                }


            },
            error:function(xhr,status,error){

                console.log('the errro is'+error);


            }
        });
    }
    });


});




</script>
</html>