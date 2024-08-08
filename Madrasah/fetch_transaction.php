<?php
include "dbConnection.php";

$result = mysqli_query($mysqli, "SELECT * FROM transaction t JOIN type ty ON t.type_id = ty.type_id ORDER BY trans_id DESC");

$output = '';
while ($res = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";
    $output .= "<td>" . htmlspecialchars($res['sender_name']) . "</td>";
    $output .= "<td>" . htmlspecialchars($res['trans_medium']) . "</td>";
    $output .= "<td>" . htmlspecialchars($res['type_name']) . "</td>";
    $output .= "<td>" . htmlspecialchars($res['date']) . "</td>";
    $output .= "<td>" . htmlspecialchars($res['amount']) . "</td>";
    $output .= "<td>
                <button class='button is-update editBtn' data-id='" . $res['trans_id'] . "'><i class='fas fa-edit'></i></button>
                <a class='button is-delete' href='#' data-id='" . htmlspecialchars($res['trans_id']) . "' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-trash-alt'></i></a>
              </td>";
    $output .= "</tr>";
}

echo $output;
?>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close pb-3">&times;</span>
            <p class="has-text-weight-semibold pb-3">Are you sure you want to delete this edit_trans_medium?</p>
            <a href="#" id="confirmDelete" class="button is-delete2 is-small ">Delete</a>
            <button class="button is-small is-custom3" id="cancelDelete">Cancel</button>

        </div>
    </div>

    <script>
      
      $(document).ready(function () {
            var modal = $('#deleteModal');
            var span = $('.close');
            var cancelDelete = $('#cancelDelete');
            var confirmDelete = $('#confirmDelete');

            $('a[data-toggle="modal"]').click(function (event) {
                event.preventDefault();
                var userId = $(this).data('id');
                confirmDelete.attr('href', 'delete.php?id=' + userId);
                modal.show();
            });

            span.click(function () {
                modal.hide();
            });

            cancelDelete.click(function () {
                modal.hide();
            });

            $(window).click(function (event) {
                if ($(event.target).is(modal)) {
                    modal.hide();
                }
            });
        });
    </script>