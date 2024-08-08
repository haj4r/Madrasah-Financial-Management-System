<!DOCTYPE html>
<html lang="en">

<?php
require 'dbConnection.php'; // Ensure this file correctly connects to your database
session_start();
?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/d21aa4c3aa.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
            width: 20%;
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



<body>
    <div id="notificationContainer" class="notification-container"></div>
    <div class="content-wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <section class="section">
                <div class="is-flex is-justify-content-space-between is-align-items-center ">
                    <div>
                        <h2 class="title">Clerk List</h2>
                    </div>

                    <div class="is-flex is-justify-content-space-between is-align-items-right pb-4">
                        <button class="button is-custom has-text-weight-semibold" id="addNewBtn">Add New Clerk</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Clerk ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="clerkTableBody">
                        <?php
                        // Fetch clerks from the database
                        $sql = "SELECT c.clerk_id, c.clerk_name, c.clerk_email, c.clerk_phonenum, s.status, l.login_id, l.status_id
                        FROM login l
                        JOIN clerk c ON l.login_id = c.login_id
                        JOIN status s ON l.status_id = s.status_id ORDER BY clerk_id ASC";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['clerk_id']}</td>";
                                echo "<td>{$row['clerk_name']}</td>";
                                echo "<td>{$row['clerk_email']}</td>";
                                echo "<td>{$row['clerk_phonenum']}</td>";
                                echo "<td>{$row['status']}</td>";
                                echo "<td>  
                                        <a class='button is-delete' href='#' 
                                        data-id='" . htmlspecialchars($row['login_id']) . "' 
                                        data-status='" . htmlspecialchars($row['status_id']) . "' 
                                        data-toggle='modal' data-target='#updateModal'>
                                        <i class='fas fa-user-times'></i>
                                        </a>
                                    </td>";


                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </section>
        </div>


        <!-- Add Clerk Modal -->
        <div class="modal" id="addClerkModal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">New Clerk</p>
                    <button class="delete" id="closeModal" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form action="" method="post" id="addUserForm">
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
                            <label class="label">Clerk Name</label>
                            <div class="control">
                                <input class="input" type="text" name="clerk_name">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Phone Number</label>
                            <div class="control">
                                <input class="input" type="text" name="clerk_phonenum">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" name="clerk_email" required>
                            </div>
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-custom has-text-weight-semibold" type="submit">Add Clerk</button>
                            </div>
                            <div class="control">
                                <button class="button is-link" id="cancelAddBtn">Cancel</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>




    <div id="updateModal" class="modal">
        <div class="modal-content">
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Submit handler for adding new user
            $(document).on('submit', '#addUserForm', function(e) {
                e.preventDefault();

                const addClerkModal = document.getElementById('addClerkModal');
                var formData = new FormData(this);
                formData.append("submit_ajaxAddClerkUser", true);
                console.log(formData);

                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                            var res = JSON.parse(response);
                            console.log(response);

                            if (res.status == 100) {
                                addClerkModal.classList.remove('is-active');
                                $('#addUserForm').find('input[type=text], input[type=password], input[type=email]').val('');
                                showNotification(res.message,res.status);
                                fetchTableData();
                            } else if (res.message == "User Already Exists"){
                                showError("User Already Exists");
                            }
                            else{

                                showError("Invalid WRONG");

                            }
                    },
                    error: function(xhr, status, error) {
                        showError("Failed to add data. Please try again.");
                    }
                });
            });
        });
    </script>

    <script>
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
                var actionURL = (status == 1) ? 'activeClerk.php' : 'activeClerk.php';

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


        // JavaScript to handle modal opening and closing

        document.addEventListener('DOMContentLoaded', () => {
            const addNewBtn = document.getElementById('addNewBtn');
            const addClerkModal = document.getElementById('addClerkModal');
            const addClerkModalClose = addClerkModal.querySelector('.delete');
            const cancelAddBtn = document.getElementById('cancelAddBtn');

            addNewBtn.addEventListener('click', () => {
                addClerkModal.classList.add('is-active');
            });

            addClerkModalClose.addEventListener('click', () => {
                addClerkModal.classList.remove('is-active');
            });

            cancelAddBtn.addEventListener('click', () => {
                addClerkModal.classList.remove('is-active');
            });
        });





        // Function to show modal for adding a new clerk
        document.addEventListener('DOMContentLoaded', () => {
            const addNewBtn = document.getElementById('addNewBtn');

            addNewBtn.addEventListener('click', () => {
                addClerkModal.classList.add('is-active');
            });

            cancelAddBtn.addEventListener('click', () => {
                addClerkModal.classList.remove('is-active');
            });
        });



                // Function to fetch and update table data
                function fetchTableData() {
            $.ajax({
                url: 'fetch_clerk.php',
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
    </script>
</body>

</html>