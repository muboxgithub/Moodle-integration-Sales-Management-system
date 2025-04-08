<?php

use enrol_lti\local\ltiadvantage\lib\http_response;

function enrollUserInCoursesecond($courseid, $userid) {
    global $DB;
    require_once(__DIR__ . '/../../enrol/manual/lib.php');
    $enrol = enrol_get_plugin('manual'); 
    $instances = enrol_get_instances($courseid, true);
    $manualinstance = null;

    foreach ($instances as $instance) {
        if ($instance->enrol === 'manual') {
            $manualinstance = $instance;
            break;
        }
    }

    if ($manualinstance) {
        $enrol->enrol_user($manualinstance, $userid, 5); // 5 is the student role ID
        return true;
    }

    return false;
}



/**
 * function for enrolling the user when the button accept click
 * @param $conn this connection from connection2.php
 * @param $userid this user id is from moodle 
 * @param $catagoryid $this catagory is in array format
 * @param $timeend is neeed but it is in array for enrol users in each catagory courses
 */
function enrollUserInCourses($conn, $userid, $categoryids,$timeend) {
    $response = array();


    
    foreach ($categoryids as $index => $categoryid) {
        // Fetch courses in the category
        $sqlCategory = "SELECT id FROM `mdl_course` WHERE `category` = ?";
        $stmtCategory = $conn->prepare($sqlCategory);
        $stmtCategory->bind_param('i', $categoryid);
        $stmtCategory->execute();
        $resultCategory = $stmtCategory->get_result();
    
        if ($resultCategory->num_rows > 0) {
            while ($rowCategory = $resultCategory->fetch_assoc()) {
                $courseid = $rowCategory['id'];
    
                // Fetch manual enrolment methods for the course
                $sqlEnrol = "SELECT id FROM `mdl_enrol` WHERE `courseid` = ? AND enrol = 'manual'";
                $stmtEnrol = $conn->prepare($sqlEnrol);
                $stmtEnrol->bind_param('i', $courseid);
                $stmtEnrol->execute();
                $resultEnrol = $stmtEnrol->get_result();
    
                if ($resultEnrol->num_rows > 0) {
                    while ($rowEnrol = $resultEnrol->fetch_assoc()) {
                        $enrolid = $rowEnrol['id'];
                        $timecreated = time();
                        $timemodified = time();
                        $timestart = time();
                        $timeendForThisCategory = $timeend[$index]; // Get the respective timeend for the category
                        $enrolstartdate = time();
                        $timestamp = strtotime("+$timeendForThisCategory months", $enrolstartdate);
                        // Insert enrolment for the user
                        $sqlInsertEnrolment = "INSERT INTO `mdl_user_enrolments` (`enrolid`, `userid`, `timestart`, `timeend`, `timecreated`, `timemodified`) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmtInsertEnrolment = $conn->prepare($sqlInsertEnrolment);
                        $stmtInsertEnrolment->bind_param('iiiiii', $enrolid, $userid, $timestart, $timestamp, $timecreated, $timemodified);
    
                        if ($stmtInsertEnrolment->execute()) {
                            // Fetch contextid for the course
                            $sqlContextid = "SELECT id FROM `mdl_context` WHERE `contextlevel` = 50 AND `instanceid` = ?";
                            $stmtContextid = $conn->prepare($sqlContextid);
                            $stmtContextid->bind_param('i', $courseid);
                            $stmtContextid->execute();
                            $resultContextid = $stmtContextid->get_result();
    
                            if ($resultContextid->num_rows > 0) {
                                while ($rowContextid = $resultContextid->fetch_assoc()) {
                                    $contextidget = $rowContextid['id'];
    
                                    $roleid = 5; // Assign the student role
                                    $modifierid = 2;
                                    $timemodifiedInAssign = time();
    
                                    // Insert role assignment for the user
                                    $sqlInsertRoleassignment = "INSERT INTO `mdl_role_assignments` (`roleid`, `contextid`, `userid`, `timemodified`, `modifierid`) VALUES (?, ?, ?, ?, ?)";
                                    $stmtRoleassign = $conn->prepare($sqlInsertRoleassignment);
                                    $stmtRoleassign->bind_param('iiiii', $roleid, $contextidget, $userid, $timemodifiedInAssign, $modifierid);
    
                                    if ($stmtRoleassign->execute()) {
                                        $response[] = array(
                                            'message' => "User enrolled successfully and assigned role for course ID $courseid",
                                        );
                                        http_response_code(200);
                                    } else {
                                        $response[] = array(
                                            'message' => "Role assignment failed for course ID $courseid",
                                        );
                                        http_response_code(500);
                                    }
                                }
                            } else {
                                $response[] = array(
                                    'message' => "Context not found for course ID $courseid",
                                );
                                http_response_code(404);
                            }
                        } else {
                            $response[] = array(
                                'message' => "Enrolment failed for course ID $courseid",
                            );
                            http_response_code(500);
                        }
                    }
                } else {
                    $response[] = array(
                        'message' => "No manual enrolment found for course ID $courseid",
                    );
                    http_response_code(404);
                }
            }
        } else {
            $response[] = array(
                'message' => "No courses found in the selected category $categoryid",
            );
            http_response_code(404);
        }
    }

    return $response;
}

// Example usage




/**
 * 
 * 
 * method for unreol
 * user when rejeccted button is clciked
 * so only delete the user id fron mdl-userenrolmetn and mdl_role assignment table
 * @param mysqli $connection
 * @param  userid of moodle
 * @param return a message
 */

//the user is id the moodle user id
 function  deleteUserEnrollmentsAndRoles ($conn, $userid){



    $sqlDuserenr="DELETE FROM `mdl_user_enrolments` WHERE `userid`=?";

    $stmtDuserenr=$conn->prepare($sqlDuserenr);

    $stmtDuserenr->bind_param('i',$userid);
    $resultDuserenr=$stmtDuserenr->execute();

    if($resultDuserenr=== true){




        $sqlDroleassign="DELETE FROM `mdl_role_assignments` WHERE `userid`=?";
        $stmtDroleassign=$conn->prepare($sqlDroleassign);

        $stmtDroleassign->bind_param('i',$userid);

       
        $resultDrolassign=  $stmtDroleassign->execute();
        if($resultDrolassign=== true){
            $stmtDuserenr->close();
            $stmtDroleassign->close();
          


            return "successfully delated the user from usr enrolemnt and role assignment table";
        }
        else{
            $stmtDuserenr->close();
            $stmtDroleassign->close();
            return "eror ocurred for delating the user";


        }

    }
    else{
        $stmtDuserenr->close();
        return "error ocurred for delating the user from enrolemtn table";
    }




 }


 /**
  * method for enroling multiple selected user 
  * @param moodleuserid of multiple user is needed like he number of totla selected row is[{"userId":46,"courseId":[2,4,5]},{"userId":1004,"courseId":"B-"},{"userId":10067,"courseId":"F"}]
  * @param  courseid for each user $name
  * @param  $conn connection is neeeded
  * 
  */


  function EnrolMultipleUsersInCourse($conn,$userCourses,$grades){


    $response=[];




    foreach($userCourses as $usercoursedata){


        $userid=$usercoursedata['userId'];
        $categoryids=$usercoursedata['categoryId'];
        $timeend=$usercoursedata['timeEnd'];

       
        foreach ($categoryids as $index => $categoryid) {
            // Fetch courses in the category
            $sqlCategory = "SELECT id FROM `mdl_course` WHERE `category` = ?";
            $stmtCategory = $conn->prepare($sqlCategory);
            $stmtCategory->bind_param('i', $categoryid);
            $stmtCategory->execute();
            $resultCategory = $stmtCategory->get_result();
        
            if ($resultCategory->num_rows > 0) {
                while ($rowCategory = $resultCategory->fetch_assoc()) {
                    $courseid = $rowCategory['id'];
        
                    // Fetch manual enrolment methods for the course
                    $sqlEnrol = "SELECT id FROM `mdl_enrol` WHERE `courseid` = ? AND enrol = 'manual'";
                    $stmtEnrol = $conn->prepare($sqlEnrol);
                    $stmtEnrol->bind_param('i', $courseid);
                    $stmtEnrol->execute();
                    $resultEnrol = $stmtEnrol->get_result();
        
                    if ($resultEnrol->num_rows > 0) {
                        while ($rowEnrol = $resultEnrol->fetch_assoc()) {
                            $enrolid = $rowEnrol['id'];
                            $timecreated = time();
                            $timemodified = time();
                            $timestart = time();
                            $timeendForThisCategory = $timeend[$index]; // Get the respective timeend for the category
                        $enrolstartdate = time();
                        $timestamp = strtotime("+$timeendForThisCategory months", $enrolstartdate); // Get the respective timeend for the category
        
                            // Insert enrolment for the user
                            $sqlInsertEnrolment = "INSERT INTO `mdl_user_enrolments` (`enrolid`, `userid`, `timestart`, `timeend`, `timecreated`, `timemodified`) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmtInsertEnrolment = $conn->prepare($sqlInsertEnrolment);
                            $stmtInsertEnrolment->bind_param('iiiiii', $enrolid, $userid, $timestart, $timestamp, $timecreated, $timemodified);
        
                            if ($stmtInsertEnrolment->execute()) {
                                // Fetch contextid for the course
                                $sqlContextid = "SELECT id FROM `mdl_context` WHERE `contextlevel` = 50 AND `instanceid` = ?";
                                $stmtContextid = $conn->prepare($sqlContextid);
                                $stmtContextid->bind_param('i', $courseid);
                                $stmtContextid->execute();
                                $resultContextid = $stmtContextid->get_result();
        
                                if ($resultContextid->num_rows > 0) {
                                    while ($rowContextid = $resultContextid->fetch_assoc()) {
                                        $contextidget = $rowContextid['id'];
        
                                        $roleid = 5; // Assign the student role
                                        $modifierid = 2;
                                        $timemodifiedInAssign = time();
        
                                        // Insert role assignment for the user
                                        $sqlInsertRoleassignment = "INSERT INTO `mdl_role_assignments` (`roleid`, `contextid`, `userid`, `timemodified`, `modifierid`) VALUES (?, ?, ?, ?, ?)";
                                        $stmtRoleassign = $conn->prepare($sqlInsertRoleassignment);
                                        $stmtRoleassign->bind_param('iiiii', $roleid, $contextidget, $userid, $timemodifiedInAssign, $modifierid);
        
                                        if ($stmtRoleassign->execute()) {
                                            $response[] = array(
                                                'message' => "User enrolled successfully and assigned role for course ID $courseid",
                                            );
                                            http_response_code(200);
                                        } else {
                                            $response[] = array(
                                                'message' => "Role assignment failed for course ID $courseid",
                                            );
                                            http_response_code(500);
                                        }
                                    }
                                } else {
                                    $response[] = array(
                                        'message' => "Context not found for course ID $courseid",
                                    );
                                    http_response_code(404);
                                }
                            } else {
                                $response[] = array(
                                    'message' => "Enrolment failed for course ID $courseid",
                                );
                                http_response_code(500);
                            }
                        }
                    } else {
                        $response[] = array(
                            'message' => "No manual enrolment found for course ID $courseid",
                        );
                        http_response_code(404);
                    }
                }
            } else {
                $response[] = array(
                    'message' => "No courses found in the selected category $categoryid",
                );
                http_response_code(404);
            }
        }
    
    
    }

    return $response;


  }

  /**
   * method fot updating the mdl_user info data
   * 
   * 
   */

   function updateUserInfo($conn,$catagoryid,$userid){

$response=[];


$selecteddata=$catagoryid[0]; 
    if ($selecteddata === 'ESSLCE Exam Natural') {
        $updatedData = 'Grade 12 Natural';
    } elseif ($selecteddata === 'ESSLCE Exam Social') {
        $updatedData = 'Grade 12 Social';
    } else {
        $updatedData = $selecteddata;
    }
        

    $sqlupdateff="UPDATE `mdl_user_info_data` SET `data`=? WHERE `userid`=? AND `fieldid`=1";
    $sqlupdatestmt=$conn->prepare($sqlupdateff);
    $sqlupdatestmt->bind_param('si',$updatedData,$userid);
    $resultsqlupdate=$sqlupdatestmt->execute();
    if($resultsqlupdate=== true){
        $response[]=array(
            'message'=>'user info data updated successfully',
            'grade'=>$selecteddata,
        );
    http_response_code(200);

    }
    else{
        $response[]=array(
            'message'=>'error ocurred in updating the user data',
        );
        http_response_code(403);
    }

  return $response;
    



 
   }


?>
