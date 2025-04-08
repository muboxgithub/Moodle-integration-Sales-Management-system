$(document).ready(function() {



    $('#submitstudent').on('click',function(){

        var studentname=$('#studentname').val();
        var studentphone=$('#studentphone').val();

        var studentschool=$('#studentschool').val();

        var studentfamily=$('#studentfamily').val();
        var agentcode=$('#agentCode').val();
        console.log('add students is clicked');

        console.log(`the agent code is ${agentcode}`);


        if(studentname=== ''){

            $('#sNerror').text('Please enter student name');
            return;
        }

        else{
            $('#sNerror').text('');
        }


        //====if the phone number of the student is null

        if(studentphone=== ''){
            $('#sPherror').text('Please enter student phone number');
            
            //========lets validate the phone number is  10 digit and start by 09 number or 07
        return;



        }

        else{
            $('#sPherror').text('');
            if (!studentphone.startsWith('09') && !studentphone.startsWith('07')) {
                $('#sPherror').text('Phone number must start with 09 or 07');
                return;
            }
        
            // Check if the phone number is exactly 10 digits long
            else if (studentphone.length !== 10) {
                $('#sPherror').text('');
                $('#sPherror').text('Phone number must be exactly 10 digits long');
                return;
            }
            else{



//=============check other fields 
if(studentschool=== ''){

    $('#sScerror').text('Please enter student school');
    return;

    }
else{
    $('#sScerror').text('');
}

//=====if the student family is null or not before checking the phone number is already taken because js is asynchronous

if(studentfamily=== ''){

    $('#sFaerror').text('Please enter student family phone');
    return;
}
else{
    if (!studentfamily.startsWith('09') && !studentfamily.startsWith('07')) {
        $('#sFaerror').text('Phone number must start with 09 or 07');
        return;
    }

    // Check if the phone number is exactly 10 digits long
    else if (studentfamily.length !== 10) {
        $('#sFaerror').text('Phone number must be exactly 10 digits long');
        return;
    }
    else{
        $('#sFaerror').text('');
    }

}


                var PhoneTaken=true;
                $.ajax({
                    url:'checkstudentphone.php',
                    method:'POST',
                    data:{Phone: studentphone},
                    success:function(response){
                        console.log('the user is already registered '+response);
                        
                        if(response.trim() === 'true'){
                            PhoneTaken=true;
                            $('#sPherror').text('Phone number is already taken');
                            return;
                        
                        }
                        else if(response.trim() === 'false') {
                            PhoneTaken=false;
                            $('#sPherror').text('');

                            if(studentname!== '' && studentphone!== '' && studentschool !== '' && studentfamily !== '' && PhoneTaken === false){


                                $.ajax({
                                    url:'addstudnetsbyagent.php',
                                    method:'POST',
                                    data:{studentName:studentname,studentPhone:studentphone,studentSchool:studentschool,studentFamily:studentfamily,agentCode:agentcode},
                                    success:function(response){
                    
                                        console.log('the response data is '+response);
                    
                                        $('#addStudentsmodal').modal('hide');
                                        //=======lets swal a fire====
                    
                                       setTimeout(function(){
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'You will be redirected to the dashboard',
                                            width:450,
                                            height:400,
                                            icon:'success',
                                            timer:3000,
                                            timerProgressBar: true,
                                            showCancelButton: false,
                                            timerOnClose: () => {
                                            // Reload the page after the timer ends
                                           
                                            }
            
                                        });
                                         location.reload();
                                       },500);
                                       
                                        
                    
                                    },
                                    error:function(error){
                                        console.log('the error is '+error);
                                    }
                    
                                });
                            }

                        }
                        else{

                        }
                       
                    },
                    error:function(xhr,status,error){
                        console.log('the error is '+error);
                        // PhoneTaken=false;
                    }
                });
               
            }


            // $('#sPherror').text('');
        }

        //====if the school of the student is null






        console.log(`the data is ${studentname},${studentphone},${studentschool},${studentfamily}`);


      
    });




    //======when belowe button is clicked the card that show student list added by agents will be shown
    $('#showstudentslists').on('click',function(){

        $('#containertable').hide();
$('#Agentaddstudentslist').show();
    });



    //==============lets makey the table of students added by agents
   
       

        
});