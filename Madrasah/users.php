<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<?php
session_start();
include "dbConnection.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/d21aa4c3aa.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>List of Clerk Users</title>
    <style>
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

        .custom-input2 {
            border-radius: 6px;
            border-width: 1px;
            border-color: #bdbdbd;
            outline: none;
            background-color: rgba(255, 255, 255, 0.3);
            color: #4a4a4a;
        }

        .custom-input2::placeholder {
            color: #bdbdbd;
        }

        .hidden {
            display: none;
        }

        .tabs {
            margin-bottom: 1.5rem;
        }

        .file-label .icon {
            margin-left: 10px;
        }

        .image.is-128x128 {
            margin-bottom: 10px;
        }

        #remove-picture {
            margin-top: 10px;
            display: inline-block;
        }

        .tabs ul li.is-active a {
            border-color: #000;
            color: #000;
        }

        .tabs ul li a {
            color: #000;
        }

        .tabs ul li a:hover {
            background-color: #00b89c;
        }

        .tabs ul li.is-active.light-theme a {
            color: #000;
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

        .custom-bg {
            background: rgb(211, 217, 220);
            background: linear-gradient(0deg, rgba(211, 217, 220, 1) 0%, rgba(216, 104, 176, 1) 100%);
        }

        .custom-bg2 {
            background: rgb(221, 158, 97);
            background: linear-gradient(0deg, rgba(221, 158, 97, 1) 0%, rgba(174, 180, 250, 1) 100%);
        }

        .custom-bg3 {
            background: rgb(221, 158, 97);
            background: linear-gradient(0deg, rgba(221, 158, 97, 1) 0%, rgba(226, 158, 159, 1) 100%);
        }

        .custom-bg4 {
            background: rgb(235, 188, 160);
            background: linear-gradient(0deg, rgba(235, 188, 160, 1) 0%, rgba(208, 166, 253, 1) 100%);
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        #chart {
            flex: 1;
            max-width: 93%;
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
    </style>
</head>

<body data-theme="light">
    <div id="notificationContainer" class="notification-container"></div>
    <div class="content-wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <section class="section">
                <div class="container">
                    <div class="is-flex is-justify-content-space-between is-align-items-center ">
                        <div>
                            <h2 class="title">All Users</h2>
                        </div>

                        <div class="is-flex is-justify-content-space-between is-align-items-right pb-4">
                            <button class="button is-custom has-text-weight-semibold is-size-6" id="addNewBtn">Add New
                                User</button>
                        </div>
                    </div>
                    <table class="table is-striped is-fullwidth">
                        <thead>
                            <tr>
                                <th>Accountant ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("dbConnection.php");
                            $result = mysqli_query($mysqli, "SELECT a.acc_id, a.acc_name, a.acc_email, a.acc_phonenum, s.status, l.login_id, l.status_id
                                        FROM login l
                                        JOIN accountant a ON l.login_id = a.login_id
                                        JOIN status s ON l.status_id = s.status_id ORDER BY a.acc_id ASC");
                            while ($res = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $res['acc_id'] . "</td>";
                                echo "<td>" . $res['acc_name'] . "</td>";
                                echo "<td>" . $res['acc_email'] . "</td>";
                                echo "<td>" . $res['acc_phonenum'] . "</td>";
                                echo "<td>" . $res['status'] . "</td>";
                                echo "<td>
                    <a class='button is-delete' href='#' 
                    data-id='" . htmlspecialchars($res['login_id']) . "' 
                    data-status='" . htmlspecialchars($res['status_id']) . "' 
                    data-toggle='modal' data-target='#updateModal'>
                    <i class='fas fa-user-times'></i>
                    </a>
                  </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>


            <!-- Add Modal -->
            <div class="modal" id="addNewModal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title has-text-weight-bold has-text-centered">Add New User</p>
                        <button class="delete" aria-label="close" id="closeModal"></button>
                    </header>
                    <section class="modal-card-body">
                        <form id="addUserForm">
                            <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id']; ?>">
                            <div class="field">
                                <label class="label">Username</label>
                                <div class="control">
                                    <input class="input" type="text" name="username" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Password</label>
                                <div class="control">
                                    <input class="input" type="password" name="password" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Account Name</label>
                                <div class="control">
                                    <input class="input" type="text" name="acc_name">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Phone Number</label>
                                <div class="control">
                                    <input class="input" type="text" name="acc_phonenum">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control">
                                    <input class="input" type="email" name="acc_email" required>
                                </div>
                            </div>
                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit">Add Account</button>
                                </div>
                                <div class="control">
                                    <button class="button is-link" id="cancelAddBtn" type="button">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var modal = $('#deleteModal');
            var span = $('.close');
            var cancelDelete = $('#cancelDelete');
            var confirmDelete = $('#confirmDelete');

            $('a[data-toggle="modal"]').click(function(event) {
                event.preventDefault();
                var userId = $(this).data('id');
                confirmDelete.attr('href', 'deleteUsers.php?id=' + userId);
                modal.show();
            });

            span.click(function() {
                modal.hide();
            });

            cancelDelete.click(function() {
                modal.hide();
            });

            $(window).click(function(event) {
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
        // Function to show notification
        function showError(message, type = 'error') {
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


        // Function to confirm deletion
        function confirmDelete(message) {
            if (confirm(message)) {
                showNotification("User Deleted Successfully"); // Show error message if canceled
                return true; // Proceed with deletion
            } else {
                showError("User deletion canceled."); // Show error message if canceled
                return false; // Cancel deletion
            }
        }

        // JavaScript to handle modal opening and closing
        document.addEventListener('DOMContentLoaded', () => {
            const addNewBtn = document.getElementById('addNewBtn');
            const addNewModal = document.getElementById('addNewModal');
            const modalCloseBtn = addNewModal.querySelector('.delete');
            const modalBackground = addNewModal.querySelector('.modal-background');

            addNewBtn.addEventListener('click', () => {
                addNewModal.classList.add('is-active');
            });

            modalCloseBtn.addEventListener('click', () => {
                addNewModal.classList.remove('is-active');
            });

            modalBackground.addEventListener('click', () => {
                addNewModal.classList.remove('is-active');
            });
        });

        // Function to fetch and update table data
        function fetchTableData() {
            $.ajax({
                url: 'fetch_acc.php',
                method: 'GET',
                success: function(response) {
                    $('tbody').html(response);
                    attachEditButtonEvents();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching table data:', error);
                }
            });
        }

        // Submit handler for adding new user
        $(document).on('submit', '#addUserForm', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("submit_ajaxAddUser", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 100) {
                        $('#closeModal').trigger('click');
                        $('#addUserForm').find('input[type=text], input[type=password], input[type=email]').val('');
                        showNotification("User Successfully Added");
                        fetchTableData();
                    } else {
                        showError("User Already Exists");
                    }
                },
                error: function(xhr, status, error) {
                    showError("Failed to add data. Please try again.");
                }
            });
        });


        $(document).ready(function() {
            // Function to handle modal actions
            var modal = $('#updateModal');
            var confirmUpdate = $('#confirmupdate');
            var cancelUpdate = $('#cancelupdate');

            // Function to show the modal and set action link
            $('a[data-toggle="modal"]').click(function(event) {
                event.preventDefault();
                var userId = $(this).data('id');
                var status = $(this).data('status');
                console.log(status)
                var actionText = (status == 1) ? 'Deactivate' : 'Activate';
                var actionClass = (status == 1) ? 'is-custom3' : 'is-custom3';
                var actionURL = (status == 1) ? 'activeAcc.php' : 'activeAcc.php';

                // Update modal content dynamically based on status
                modal.find('.modal-content').html(`
            <span class="close pb-3">&times;</span>
            <p class="has-text-weight-semibold pb-3">Are you sure you want to ${actionText} this user account?</p>
            <a href="${actionURL}?id=${userId}" class="button ${actionClass} is-small">${actionText}</a>
            <button class="button is-small is-delete2" id="cancelupdate">Cancel</button>
        `);

                modal.show();
            });

            // Close modal on cancel or outside click
            $(document).on('click', '.close, #cancelupdate', function() {
                modal.hide();
            });

            $(window).click(function(event) {
                if ($(event.target).is(modal)) {
                    modal.hide();
                }
            });
        });
    </script>
</body>

</html>