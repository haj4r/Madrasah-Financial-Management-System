<?php
require_once ("dbConnection.php");
$trans_id = $_GET['id'];
$result = mysqli_query($mysqli, "DELETE FROM transaction WHERE trans_id = $trans_id");

header("Location:transaction.php");