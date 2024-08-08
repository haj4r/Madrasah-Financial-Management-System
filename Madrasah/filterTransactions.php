<?php
require_once("dbConnection.php");

$filter_type = isset($_POST['filter_type']) ? $_POST['filter_type'] : '';
$filter_month = isset($_POST['filter_month']) ? $_POST['filter_month'] : '';

$query = "SELECT t.*, ty.type_name FROM transaction t JOIN type ty ON t.type_id = ty.type_id WHERE 1";

if ($filter_type != '') {
    $query .= " AND t.type_id = " . intval($filter_type);
}
if ($filter_month != '') {
    $query .= " AND DATE_FORMAT(t.date, '%Y-%m') = '" . mysqli_real_escape_string($mysqli, $filter_month) . "'";
}

$query .= " ORDER BY trans_id ASC";

$result = mysqli_query($mysqli, $query);

$transactions = [];
while ($res = mysqli_fetch_assoc($result)) {
    // Format the date to display only month and year
    $res['date'] = date('d F Y', strtotime($res['date']));
    $transactions[] = $res;
}

$sumQuery = "SELECT SUM(amount) AS total_amount FROM transaction t WHERE 1";
if ($filter_type != '') {
    $sumQuery .= " AND t.type_id = " . intval($filter_type);
}
if ($filter_month != '') {
    $sumQuery .= " AND DATE_FORMAT(t.date, '%Y-%m') = '" . mysqli_real_escape_string($mysqli, $filter_month) . "'";
}

$sumResult = mysqli_query($mysqli, $sumQuery);
$sumRow = mysqli_fetch_assoc($sumResult);
$totalAmount = $sumRow['total_amount'];

$response = [
    'transactions' => $transactions,
    'totalAmount' => $totalAmount
];

echo json_encode($response);

mysqli_close($mysqli);
?>
