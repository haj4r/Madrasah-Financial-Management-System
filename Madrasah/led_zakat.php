<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include "dbConnection.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Transactions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>
<style>
    .button.is-delete2 {
        background-color: #FF0000;
        border-color: #FF0000;
        color: white;
        padding: 5px 24px;
    }

    .button.is-delete2:hover,
    .button.custom2.is-hovered {
        background-color: #FFFF;
        border-color: #FF0000;
        color: #FF0000
    }

    .button.is-delete2.is-outlined:hover,
    .button.is-delete2.is-outlined.is-hovered,
    .button.is-delete2.is-outlined:focus,
    .button.is-delete2.is-outlined.is-focused {
        background-color: #FFFF;
        border-color: #FF0000;
        color: #FF0000
    }

    .content-wrapper {
        display: flex;
        height: 100vh;
    }

    .main-content {
        margin-left: 200px;
        flex-grow: 1;
        padding: 20px;
        background-color: #FFFFFF;
        overflow-y: auto;
    }

    .button.is-custom {
        background-color: #3699FF;
        border-color: #fff;
        color: #fff;
    }

    .button.is-custom:hover,
    .button.custom.is-hovered {
        background-color: #ffff;
        border-color: #3699FF;
        color: #3699FF
    }

    .button.is-custom.is-outlined:hover,
    .button.is-custom.is-outlined.is-hovered,
    .button.is-custom.is-outlined:focus,
    .button.is-custom.is-outlined.is-focused {
        background-color: #fff;
        border-color: #fff;
        color: #3699FF
    }

    .button.is-custom2 {
        background-color: #7A97A9;
        border-color: #fff;
        color: #fff
    }

    .button.is-custom2:hover,
    .button.custom2.is-hovered {
        background-color: #fff;
        border-color: #7A97A9;
        color: #7A97A9
    }

    .button.is-custom2.is-outlined:hover,
    .button.is-custom2.is-outlined.is-hovered,
    .button.is-custom2.is-outlined:focus,
    .button.is-custom2.is-outlined.is-focused {
        background-color: #fff;
        border-color: #fff;
        color: #7A97A9
    }

    .button.is-custom3 {
        background-color: #36B538;
        border-color: #fff;
        color: #fff
    }

    .button.is-custom3:hover,
    .button.custom3.is-hovered {
        background-color: #fff;
        border-color: #36B538;
        color: #36B538
    }

    .button.is-custom3.is-outlined:hover,
    .button.is-custom3.is-outlined.is-hovered,
    .button.is-custom3.is-outlined:focus,
    .button.is-custom3.is-outlined.is-focused {
        background-color: #fff;
        border-color: #fff;
        color: #36B538
    }

    .button.is-custom4 {
        background-color: #384D6C;
        border-color: #fff;
        color: #fff;
    }

    .button.is-custom4:hover,
    .button.custom.is-hovered {
        background-color: #ffff;
        border-color: #384D6C;
        color: #384D6C
    }

    .button.is-custom4.is-outlined:hover,
    .button.is-custom4.is-outlined.is-hovered,
    .button.is-custom4.is-outlined:focus,
    .button.is-custom4.is-outlined.is-focused {
        background-color: #fff;
        border-color: #fff;
        color: #384D6C
    }


    .button.is-delete {
        background-color: #fff;
        border-color: #FF0000;
        color: #FF0000;
        padding: 5px 24px;
    }

    .button.is-delete:hover,
    .button.custom2.is-hovered {
        background-color: #FFFF;
        border-color: #FF0000;
        color: #FF0000
    }

    .button.is-delete.is-outlined:hover,
    .button.is-delete.is-outlined.is-hovered,
    .button.is-delete.is-outlined:focus,
    .button.is-delete.is-outlined.is-focused {
        background-color: #FFFF;
        border-color: #FF0000;
        color: #FF0000
    }

    .button.is-update {
        border-color: #35B638;
        color: #35B638;
        padding: 5px 24px;
    }

    .button.is-update:hover,
    .button.custom2.is-hovered {
        background-color: #fff;
        border-color: #35B638;
        color: #35B638
    }

    .button.is-update.is-outlined:hover,
    .button.is-update.is-outlined.is-hovered,
    .button.is-update.is-outlined:focus,
    .button.is-update.is-outlined.is-focused {
        background-color: #fff;
        border-color: #fff;
        color: #35B638
    }

    .is-right-aligned {
        display: flex;
        justify-content: flex-end;
    }

    .table-container {
        overflow-x: auto;
        padding-top: 30px;
    }

    table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: #CBCDF5;
        border-collapse: collapse;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
    }

    th {
        background-color: #CBCDF5;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    .notification-container {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 300px;
        z-index: 1000;
    }

    .notification {
        display: flex;
        align-items: right;
        justify-content: space-between;
        padding: 20px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .notification.is-success {
        background-color: #dff0d8;
        color: #3c763d;
        font-weight: bold;
    }

    .notification.is-danger {
        background-color: #f2dede;
        color: #a94442;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 10px;
        width: 30%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<body>
    <div id="notificationContainer" class="notification-container"></div>
    <div class="content-wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <section class="section">
                <div class="container">
                    <div class="custom-border p-3 ">
                        <div class="is-flex is-justify-content-space-between is-align-items-center ">
                            <div>
                                <h2 class="has-text-weight-bold is-size-3">Zakat Ledger</h2>
                                <p class="has-text-grey-light is-size-6">More than 100+ record of debit</p>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table is-striped is-fullwidth">
                                <thead>
                                    <tr>
                                    <th>Serial No</th>
                                    <th>Date</th>
                                        <th>Sender Name</th>
                                        <th>Medium</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once ("dbConnection.php");
                                    

                                    // Fetch and display records from zakat table
                                    $result = mysqli_query($mysqli, "SELECT * FROM zakat");
                                    while ($res = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $res['ledger_id'] . "</td>";
                                        echo "<td>" . $res['date'] . "</td>";
                                        echo "<td>" . $res['sender_name'] . "</td>";
                                        echo "<td>" . $res['trans_medium'] . "</td>";
                                        echo "<td>" . $res['amount'] . "</td>";
                                        echo "</tr>";
                                    }

                                    $sumResult = mysqli_query($mysqli, "SELECT SUM(amount) AS total_amount FROM zakat");
                                    $sumRow = mysqli_fetch_assoc($sumResult);
                                    $totalAmount = $sumRow['total_amount'];

                                    echo "<tr>";
                                    echo "<td colspan='4'><strong>Total Amount:</strong></td>";
                                    echo "<td><strong>RM " . $totalAmount . "</strong></td>";
                                    echo "</tr>";

                                    mysqli_close($mysqli);
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
            </section>
        </div>
    </div>

</body>

</html>