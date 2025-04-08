<?php
include('connection3.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $messageText = $_POST['textData'];
    $receiverId = $_POST['reciverId'];
    $role = 0;
    $view = 1;
    $senderId = 0;
    // $timestamp = date('Y-m-d H:i:s'); // Specify the format for the timestamp

    $sqlquery = "INSERT INTO `messages` (`role`, `senderid`, `recevierid`, `messagetext`, `view`) VALUES (?, ?, ?, ?, ?)";

    $stmtinsert = $conn33->prepare($sqlquery);
    $stmtinsert->bind_param('iiisi', $role, $senderId, $receiverId, $messageText, $view);

    $stmtinsert->execute();

    if ($stmtinsert->affected_rows > 0) {
        echo "success";
        exit;
    } else {
        echo "error";
        exit;
    }
}
?>