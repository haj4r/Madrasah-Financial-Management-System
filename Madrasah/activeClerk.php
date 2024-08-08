<?php
// Include the database connection file
require_once("dbConnection.php");

// Function to check status of login_id
function checkStatus($mysqli, $login_id)
{
    $stmt = $mysqli->prepare("SELECT * FROM `LOGIN` WHERE login_id = ? AND status_id = 1");
    $stmt->bind_param("i", $login_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->num_rows > 0; // Return true if login_id exists, false otherwise
}

// Ensure login_id parameter is provided via GET request
if (isset($_GET['id'])) {
    $login_id = $_GET['id'];

    // Check if login_id exists
    if (checkStatus($mysqli, $login_id)) {
        $stmt = $mysqli->prepare("UPDATE `LOGIN` SET status_id = 2 WHERE login_id = ?");
        $stmt->bind_param("i", $login_id);
        if ($stmt->execute()) {
            // Successful update
            $stmt->close();
        } else {
            // Error occurred
            echo "Error updating record: " . $mysqli->error;
        }
    } else {
        $stmt = $mysqli->prepare("UPDATE `LOGIN` SET status_id = 1 WHERE login_id = ?");
        $stmt->bind_param("i", $login_id);
        if ($stmt->execute()) {
            // Successful update
            $stmt->close();
        } else {
            // Error occurred
            echo "Error updating record: " . $mysqli->error;
        }
    }


    header("Location: list-clerk.php");
    exit();
} else {
    // Redirect if id parameter is not provided
    header("Location: list-clerk.php");
    exit();
}
?>
