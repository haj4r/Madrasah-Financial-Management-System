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
    <title>User Profile</title>
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
                    <h1 class="title has-text-grey"><?php echo ucfirst($_SESSION['username']) ?>
                        (<?php echo $_SESSION['category'] ?>)</h1>
                    <div class="column is-one-two">
                        <figure class="image is-128x128" style="border-radius: 50%; background-color: black;">
                            <img id="profile-img" src="" alt=""
                                style="height: -webkit-fill-available !important; border-radius: 50%;">
                        </figure>
                        <a id="remove-picture" href="#" class="has-text-danger hover-underline is-size-6 p-1">Remove
                            picture</a>
                        <div class="file is-small">
                            <label class="file-label">
                                <input class="file-input" type="file" name="profile-picture" id="profile-picture">
                                <span class="button is-custom file-label has-text-weight-semibold">Upload picture</span>
                            </label>
                        </div>
                    </div>
                    <div class="column">
                        <div class="tabs is-boxed">
                            <ul>
                                <li class="is-active" data-tab="details-tab"><a>My details</a></li>
                                <li data-tab="password-tab"><a>Password</a></li>
                            </ul>
                        </div>
                        <div id="details-tab" class="tab-content">
                            <form id="ajaxInsertPrincipal">
                                <div class="columns">
                                    <div class="column is-one-third">
                                        <div class="field">
                                            <input type="hidden" name="principal_login_id" id="principal_login_id"
                                                value="<?php echo $_SESSION['login_id'] ?>">
                                            <label class="label has-text-grey">Name</label>
                                            <div class="control">
                                                <input class="input custom-input2" type="text" placeholder="Name"
                                                    name="principalName" id="principalName">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-one-third">
                                        <div class="field">
                                            <label class="label has-text-grey">Phone Number</label>
                                            <div class="control">
                                                <input class="input custom-input2" type="text"
                                                    placeholder="Phone Number" name="principalPhonenum"
                                                    id="principalPhonenum">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column is-one-third">
                                        <div class="field">
                                            <label class="label has-text-grey">Email Address</label>
                                            <div class="control">
                                                <input class="input custom-input2" type="text"
                                                    placeholder="Email Address" name="principalEmail"
                                                    id="principalEmail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-custom4 has-text-weight-semibold">Save
                                            settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="password-tab" class="tab-content hidden">
                            <form id="ajaxPricipalPassword">
                                <div class="columns">
                                    <div class="column is-one-third">
                                        <div class="field">
                                            <input type="hidden" name="principal_login_id" id="principal_login_id"
                                                value="<?php echo $_SESSION['login_id'] ?>">
                                            <label class="label has-text-grey">Current Password</label>
                                            <div class="control">
                                                <input class="input custom-input2" type="password"
                                                    placeholder="Current Password" name="currentPassword" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-one-third">
                                        <div class="field">
                                            <label class="label has-text-grey">New password</label>
                                            <div class="control">
                                                <input class="input custom-input2" type="password"
                                                    placeholder="New password" name="newPassword" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column is-one-third">
                                        <div class="field">
                                            <label class="label has-text-grey">Confirm New Password</label>
                                            <div class="control">
                                                <input class="input custom-input2" type="password"
                                                    placeholder="Confirm New Password" name="confirmPassword" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-custom4">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

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

        $(document).ready(function () {
            var principal_login_id = $('#principal_login_id').val();
            console.log(principal_login_id);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: {
                    'principal_login_id': principal_login_id
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.error) {
                        console.log("Error: " + response.error);
                    } else {
                        var data = response.data;

                        $('#principalName').val(data.principal_name);
                        $('#principalPhonenum').val(data.principal_phonenum);
                        $('#principalEmail').val(data.principal_email);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
        });

        $(document).on('submit', '#ajaxInsertPrincipal', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("submit_ajaxInsertPrincipal", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 100) {

                        showNotification("Profile Updated Succesfuly");

                    } else {

                        showError("Profile Updated Failed");
                    }
                }
            });
        });

        $(document).on('submit', '#ajaxPricipalPassword', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("submit_ajaxPricipalPassword", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status === 200) {
                        showNotification("Password updated successfully!");
                    } else {
                        showError(res.message);
                    }
                },
                error: function () {
                    showError("An error occurred while processing your request.");
                }
            });
        });

        document.getElementById('profile-picture').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('profile-img').src = e.target.result;
            };

            reader.readAsDataURL(file);
        });

        document.getElementById('remove-picture').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('profile-img').src = 'https://via.placeholder.com/128';
            document.getElementById('profile-picture').value = '';
        });

        document.querySelectorAll('.tabs ul li').forEach(tab => {
            tab.addEventListener('click', function () {
                document.querySelectorAll('.tabs ul li').forEach(tab => tab.classList.remove('is-active'));
                tab.classList.add('is-active');

                const targetTab = tab.getAttribute('data-tab');
                document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
                document.getElementById(targetTab).classList.remove('hidden');
            });
        });
    </script>
</body>

</html>