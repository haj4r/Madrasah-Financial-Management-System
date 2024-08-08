<?php
require_once("dbConnection.php");

// Fetch data from database
$sql = "SELECT c.clerk_id, c.clerk_name, c.clerk_email, c.clerk_phonenum, s.status, l.login_id, l.status_id
        FROM login l
        JOIN clerk c ON l.login_id = c.login_id
        JOIN status s ON l.status_id = s.status_id
        ORDER BY c.clerk_id ASC";

$result = mysqli_query($mysqli, $sql);

if ($result) {
    // Loop through results and output rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['clerk_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['clerk_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['clerk_email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['clerk_phonenum']) . '</td>';
        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
        echo '<td>';
        echo '<a class="button is-delete" href="#" 
                data-id="' . htmlspecialchars($row['login_id']) . '" 
                data-status="' . htmlspecialchars($row['status_id']) . '" 
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
