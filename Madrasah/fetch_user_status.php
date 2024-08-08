<?php
// fetch_user_status.php
require 'dbConnection.php'; // Ensure this file correctly connects to your database

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user status
    $sql = "SELECT status_id FROM `login` WHERE login_id = $userId";
    $result = $mysqli->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $status = $row['status_id'];

        // Prepare JSON response
        $response = [
            'status' => 'success',
            'data' => [
                'status' => $status
            ]
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error fetching user status'
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'No user ID provided'
    ];
    echo json_encode($response);
}
?>
