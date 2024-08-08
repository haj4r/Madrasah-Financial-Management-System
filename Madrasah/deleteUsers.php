<?php
// Include the database connection file
require_once ("dbConnection.php");

// Function to delete from accountant table
function deleteFromAccountant($mysqli, $login_id)
{
    $stmt = $mysqli->prepare("DELETE FROM accountant WHERE login_id = ?");
    $stmt->bind_param("i", $login_id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete from login table
function deleteFromLogin($mysqli, $login_id)
{
    $stmt = $mysqli->prepare("UPDATE FROM accountant WHERE login_id = ?");
    $stmt->bind_param("i", $login_id);
    $stmt->execute();
    $stmt->close();
}

// Get login_id parameter value from URL
if (isset($_GET['id'])) {
    $login_id = $_GET['id'];

    // Delete from accountant table first
    deleteFromAccountant($mysqli, $login_id);

    // Then delete from login table
    deleteFromLogin($mysqli, $login_id);

    // Redirect to the main display page (transaction.php in our case)
    header("Location: users.php");
    exit();
} else {
    // Redirect if id parameter is not provided
    header("Location: users.php");
    exit();
}
?>