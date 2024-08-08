<?php
require_once("dbConnection.php");

if (isset($_POST['id'])) {
    $sender_name = $_POST['sender_name'];
    $trans_medium = $_POST['trans_medium'];
    $type_id = $_POST['type_id'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];

    $result = mysqli_query($mysqli, "UPDATE transaction SET sender_name='$sender_name', trans_medium='$trans_medium', type_id='$type_id', date='$date', amount='$amount' WHERE trans_id=$id");

    if ($result) {
        header("Location: transaction.php");
    } else {
        echo "Error updating data";
    }
} else {
    echo "Invalid data";
}
?>
