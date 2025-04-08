<?php
include('../connection.php');

include('Allfunction.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $promodid = $_POST['promoId'];

    $promocode=$_POST['promoCode'];

    $userid=getUserId($promocode,$conn3);
    $sqlsearch = "SELECT agent_id FROM `agent` WHERE `agent_id`=? UNION SELECT agent_id FROM `agent` WHERE `parent_id`=?";

    
    $stmt = $conn3->prepare($sqlsearch);
    $stmt->bind_param('si',$promocode,$userid);
    $stmt->bind_param('si',$promocode,$userid);

    $stmt->execute();
    $resultstmt = $stmt->get_result();
    $resultrow = [];

    if ($resultstmt->num_rows > 0) {
        while ($row = $resultstmt->fetch_assoc()) {
            $resultrow[] = $row['agent_id'];
        }
        echo json_encode($resultrow); // Encode the result array as JSON and return
    } else {
        echo json_encode(['error' => 'No results found']); // Return an error message in JSON format
    }
} else {
    echo json_encode(['error' => 'Invalid request']); // Return an error message for invalid request
}
?>