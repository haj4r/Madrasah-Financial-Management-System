<?php
include "dbConnection.php";

if (isset($_GET['id'])) {
    $trans_id = $_GET['id'];
    $query = "SELECT * FROM transaction WHERE trans_id = $trans_id";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Transaction not found"]);
    }
}
?>
