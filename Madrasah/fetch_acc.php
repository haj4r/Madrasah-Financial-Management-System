<?php
require_once("dbConnection.php");

// Fetch data from database
$sql = "SELECT a.acc_id, a.acc_name, a.acc_email, a.acc_phonenum, s.status, l.login_id, l.status_id
        FROM login l
        JOIN accountant a ON l.login_id = a.login_id
        JOIN status s ON l.status_id = s.status_id
        ORDER BY a.acc_id ASC";

$result = mysqli_query($mysqli, $sql);

if ($result) {


    // Loop through results and output rows
    while ($res = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($res['acc_id']) . '</td>';
        echo '<td>' . htmlspecialchars($res['acc_name']) . '</td>';
        echo '<td>' . htmlspecialchars($res['acc_email']) . '</td>';
        echo '<td>' . htmlspecialchars($res['acc_phonenum']) . '</td>';
        echo '<td>' . htmlspecialchars($res['status']) . '</td>';
        echo '<td>';
        echo '<a class="button is-delete" href="#" 
                    data-id="' . htmlspecialchars($res['login_id']) . '" 
                    data-status="' . htmlspecialchars($res['status_id']) . '" 
                    data-toggle="modal" data-target="#updateModal">';
        echo '<i class="fas fa-trash-alt"></i>';
        echo '</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    // Free result set
    mysqli_free_result($result);
} else {
    echo 'Error: ' . mysqli_error($mysqli);
}

// Close connection
mysqli_close($mysqli);
?>