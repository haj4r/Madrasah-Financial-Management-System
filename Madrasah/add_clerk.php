<?php
require 'dbConnection.php'; // Ensure this file correctly connects to your database
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_ajaxAddClerkUser'])) {
    // Collect and sanitize form data
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $clerk_name = $_POST['clerk_name'];
    $clerk_phonenum = $_POST['clerk_phonenum'];
    $clerk_email = $_POST['clerk_email'];

    $login_id = $_SESSION['login_id'];
    $principal_id = $_SESSION['principal_id'];

    $category = 'Clerk';
    $status = 1;

    // Check if the user already exists
    $checkUserQuery = "SELECT * FROM login WHERE username = ?";
    $checkUserStmt = $mysqli->prepare($checkUserQuery);
    $checkUserStmt->bind_param('s', $username);
    $checkUserStmt->execute();
    $checkUserResult = $checkUserStmt->get_result();

    if ($checkUserResult->num_rows > 0) {
        echo json_encode(['status' => 200, 'message' => 'User Already Exists']);
    } else {
        // Insert into login table
        $insertLoginQuery = "INSERT INTO login (username, password, category, status_id) VALUES (?, ?, ?, ?)";
        $insertLoginStmt = $mysqli->prepare($insertLoginQuery);
        // Note: Password should be hashed before binding
        $insertLoginStmt->bind_param('sssi', $username, $password, $category, $status);
        
        if ($insertLoginStmt->execute()) {
            // Get the last inserted login_id
            $login_id = $mysqli->insert_id;

            // Insert into clerk table
            $insertClerkQuery = "INSERT INTO clerk (login_id, clerk_name, clerk_phonenum, clerk_email, principal_id) VALUES (?, ?, ?, ?, ?)";
            $insertClerkStmt = $mysqli->prepare($insertClerkQuery);
            $insertClerkStmt->bind_param('isssi', $login_id, $clerk_name, $clerk_phonenum, $clerk_email, $principal_id);
            
            if ($insertClerkStmt->execute()) {
                echo json_encode(['status' => 100, 'message' => 'User Successfully Added']);
            } else {
                echo json_encode(['status' => 102, 'message' => 'Failed to insert into clerk table']);
            }
        } else {
            echo json_encode(['status' => 103, 'message' => 'Failed to insert into login table']);
        }
    }

    // Close statements and connection
    $checkUserStmt->close();
    $insertLoginStmt->close();
    $insertClerkStmt->close();
    $mysqli->close();

} else {
    echo json_encode(['status' => 104, 'message' => 'Invalid Request']);
}
?>
