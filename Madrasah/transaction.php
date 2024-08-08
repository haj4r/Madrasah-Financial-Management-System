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
                                <h2 class="has-text-weight-bold is-size-3">Transaction</h2>
                                <p class="has-text-grey-light is-size-6">More than 100+ transactions</p>
                            </div>
                            <div>
                                <button class="button is-custom has-text-weight-semibold" id="addNewBtn">+ New
                                    Transaction</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table is-striped is-fullwidth">
                                <thead>
                                    <tr>
                                        <th>Sender Name</th>
                                        <th>Medium</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once ("dbConnection.php");
                                    $result = mysqli_query($mysqli, "SELECT * FROM transaction t JOIN type ty ON t.type_id = ty.type_id ORDER BY trans_id DESC");
                                    while ($res = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $res['sender_name'] . "</td>";
                                        echo "<td>" . $res['trans_medium'] . "</td>";
                                        echo "<td>" . $res['type_name'] . "</td>";
                                        echo "<td>" . $res['date'] . "</td>";
                                        echo "<td>" . $res['amount'] . "</td>";
                                        echo "<td>
                                <button class='button is-update editBtn' data-id='" . $res['trans_id'] . "'><i class='fas fa-edit'></i></button>
                                <a class='button is-delete' href='#' data-id='" . htmlspecialchars($res['trans_id']) . "' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-trash-alt'></i></a>
                              </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </section>

            <!-- Add Modal -->
            <div class="modal" id="addModal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head has-text-weight-semibold" style="background-color: #CBCDF5;">
                        <p class="modal-card-title">Add New Transaction</p>
                        <button class="delete" id="closeModal" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <form id="ajaxAddTransaction">
                            <div class="field">
                                <label class="label">Sender Name:</label>
                                <div class="control">
                                    <input class="input" type="text" name="sender_name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Medium:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="trans_medium" required>
                                            <option hidden value="">Select Medium</option>
                                            <option value="Online Banking">Online Banking</option>
                                            <option value="e-Wallet">e-Wallet</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Type:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="type_id" required>
                                            <option hidden value="">Select Type</option>
                                            <option value="1">Zakat</option>
                                            <option value="2">Donation</option>
                                            <option value="3">Fee</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Date:</label>
                                <div class="control">
                                    <input class="input" type="date" name="date" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Amount(Ex: 1234):</label>
                                <div class="control">
                                    <input class="input" type="text" name="amount" required>
                                </div>
                            </div>
                            <div class="is-right-aligned">
                                <button class="button is-custom4" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal" id="editModal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head" style="background-color: #CBCDF5;">
                        <p class="modal-card-title has-text-weight-semibold">Edit Transaction</p>
                        <button id="closeModalEdit" class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body">
                        <form id="ajaxEditTransaction">
                            <input type="text" name="edit_id" id="editId" hidden>
                            <div class="field">
                                <label class="label">Sender Name:</label>
                                <div class="control">
                                    <input class="input" type="text" name="edit_sender_name" id="editSenderName"
                                        required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Medium:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="edit_trans_medium" required>
                                            <option value="">Select Medium</option>
                                            <option value="Online Banking">Online Banking</option>
                                            <option value="e-Wallet">e-Wallet</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Type:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="edit_type_name" id="editType" required>
                                            <option hidden value="">Select Type</option>
                                            <option value="1">Zakat</option>
                                            <option value="2">Donation</option>
                                            <option value="3">Fee</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Date:</label>
                                <div class="control">
                                    <input class="input" type="date" name="edit_date" id="editDate" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Amount:</label>
                                <div class="control">
                                    <input class="input" type="text" name="edit_amount" id="editAmount" required>
                                </div>
                            </div>
                            <div class="is-right-aligned">
                                <button class="button is-custom4" type="submit">Update</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close pb-3">&times;</span>
            <p class="has-text-weight-semibold pb-3">Are you sure you want to delete this transactions?</p>
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

        // Function to show notification
        function showNotification(message, type = 'success') {
            const notificationContainer = document.getElementById('notificationContainer');

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification ${type === 'error' ? 'is-danger' : 'is-success'}`;
            notification.innerHTML = `
            <span>${message}</span>
            <button class="delete"></button>
        `;

            notification.querySelector('.delete').addEventListener('click', () => {
                notificationContainer.removeChild(notification);
            });

            notificationContainer.appendChild(notification);

            setTimeout(() => {
                if (notification.parentNode === notificationContainer) {
                    notificationContainer.removeChild(notification);
                }
            }, 5000);
        }

        // Function to fetch and update table data
        function fetchTableData() {
            $.ajax({
                url: 'fetch_transaction.php',
                method: 'GET',
                success: function (response) {
                    $('tbody').html(response);
                    attachEditButtonEvents();
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching table data:', error);
                }
            });
        }

        // Function to attach edit button events
        function attachEditButtonEvents() {
            $('.editBtn').off('click').on('click', function () {
                const id = $(this).data('id');

                // Fetch transaction data
                fetch(`edit.php?id=${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error:', data.error);
                            return;
                        }

                        // Log data for debugging
                        console.log(data);

                        document.getElementById('editId').value = data.trans_id;
                        document.getElementById('editSenderName').value = data.sender_name;

                        // Set value for edit_trans_medium select element
                        document.querySelector('#editModal select[name="edit_trans_medium"]').value = data.trans_medium;

                        // Set value for edit_type_name select element
                        document.querySelector('#editModal select[name="edit_type_name"]').value = data.type_id;
                        document.querySelector('#editModal input[name="edit_date"]').value = data.date;  // Assuming your key is 'date'
                        document.querySelector('#editModal input[name="edit_amount"]').value = data.amount;  // Assuming your key is 'amount'

                        $('#editModal').addClass('is-active');
                    })
                    .catch(error => console.error('Error:', error));
            });
        }

        // Document ready
        $(document).ready(function () {
            // Add New Data modal
            const addNewBtn = document.getElementById('addNewBtn');
            const addModal = document.getElementById('addModal');
            const closeModalButtons = document.querySelectorAll('.delete');

            addNewBtn.addEventListener('click', () => {
                addModal.classList.add('is-active');
            });

            closeModalButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    addModal.classList.remove('is-active');
                    editModal.classList.remove('is-active');
                });
            });

            // Edit modal
            const editModal = document.getElementById('editModal');

            // Initial attachment of edit button events
            attachEditButtonEvents();
        });

        // Submit handler for adding new transaction
        $(document).on('submit', '#ajaxAddTransaction', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("submit_ajaxAddTransaction", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 100) {
                        $('#closeModal').trigger('click');
                        showNotification("Data Successfully Added");
                        fetchTableData();
                    } else {
                        showNotification("Data Already Exists", 'error');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error adding transaction:', error);
                    showNotification("Failed to add data. Please try again.", 'error');
                }
            });
        });

        // Submit handler for editing transaction
        $(document).on('submit', '#ajaxEditTransaction', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("submit_ajaxEditTransaction", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 100) {
                        $("#closeModalEdit").trigger('click');
                        showNotification("Update Success");
                        fetchTableData();
                    } else {
                        showNotification("Update Failed", 'error');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error updating transaction:', error);
                    showNotification("Failed to update data. Please try again.", 'error');
                }
            });
        });

    </script>



</body>

</html>