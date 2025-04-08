<?php

/**
 * Deletes users from the `transaction_bank` table where the `Timestamp` is older than 24 hours and the `Status` is `rejected`.
 * 
 * @param mysqli $conn The database connection.
 * @return bool True on success, false on failure.
 */
function deleteUsersAfterTime($conn)
{
    try {
        // SQL query to delete entries older than 24 hours with 'rejected' status
        $sqlDeleteReject = "DELETE FROM `transaction_bank` WHERE `Timestamp` < ? AND `status` = 'rejected'";

        // Calculate the date 24 hours ago
        $startDate = new DateTime();
        $startDate->sub(new DateInterval('PT24H'));
        $formattedDate = $startDate->format('Y-m-d H:i:s');

        // Prepare the statement
        if ($stmtDeleteReject = $conn->prepare($sqlDeleteReject)) {

            // Bind the parameter
            if ($stmtDeleteReject->bind_param('s', $formattedDate)) {

                // Execute the statement
                if ($stmtDeleteReject->execute()) {
                    // Successfully executed
                    $stmtDeleteReject->close();
                    return true;
                } else {
                    // Execution failed
                    error_log("Execution failed: " . $stmtDeleteReject->error);
                }
            } else {
                // Binding parameters failed
                error_log("Binding parameters failed: " . $stmtDeleteReject->error);
            }
        } else {
            // Prepare statement failed
            error_log("Prepare statement failed: " . $conn->error);
        }
        
    } catch (Exception $e) {
        // Log any unexpected exceptions
        error_log("Exception caught: " . $e->getMessage());
    }

    return false; // Return false if any part of the process fails
}
