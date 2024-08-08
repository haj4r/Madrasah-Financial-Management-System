<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include "dbConnection.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUSAT PENGAJIAN MINHAJUL ABIDIN FINANCIAL MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
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

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 50px 0;
            flex-direction: column;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 70px;
            border-radius: 10px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .login-image {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

        .image-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .login-container-inner {
            display: flex;
            flex-direction: row;
            width: 70%;
            height: 70vh;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .login-left {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-right {
            width: 50%;
            padding-bottom: 140px;
            padding-left: 40px;
            padding-right: 40px;
            padding-top: 0px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-box h1 {
            color: #000;
        }

        .login-box p {
            color: #6c757d;
        }

        .login-box .button {
            background-color: #7C3DBF;
            color: #fff;
        }

        .login-box .button2 {
            background-color: #ffff;
            color: #0000;
        }

        .login-box .input {
            background-color: #f0f0f0;
            border: none;
        }

        @media (min-width: 576px) {
            .login-container {
                padding: 50px;
            }
        }

        @media (max-width: 768px) {
            .login-container-inner {
                flex-direction: column;
                height: auto;
            }

            .login-left,
            .login-right {
                width: 100%;
            }

            .image-container {
                height: 50vh;
            }
        }

        @media (max-width: 425px) {

            .login-container-inner {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 80%;
            }

            .login-left,
            .login-right {
                padding: 2px;
            }

            .image-container {
                height: 40vh;
                border-radius: 10px;
            }
        }
    </style>
</head>

<body>
<div id="notificationContainer" class="notification-container"></div>
    <div class="login-container">
    <div class="login-container-inner">
            <div class="login-right">
            <p class="title has-text-weight-bold is-size-5 has-text-grey">PUSAT PENGAJIAN MINHAJUL ABIDIN FINANCIAL MANAGEMENT SYSTEM</p>
                <div class="login-box mt-5">
                    <div class="has-text-left">
                        <p class="title has-text-weight-bold is-size-3 has-text-black">Welcome!</p>
                        <p class="subtitle has-text-grey has-text-weight-semibold is-size-6 mb-5">Please enter your details
                        </p>
                    </div>
                    <form id="ajaxLogin">
                        <div class="field mb-5">
                            <div class="control">
                                <input class="input" type="text" name="username" placeholder="username">
                            </div>
                        </div>
                        <div class="field mb-5">
                            <div class="control">
                                <input class="input" type="password" name="password" placeholder="password">
                            </div>
                        </div>
                        <div class="field">
                            <button class="button is-fullwidth has-text-weight-semibold" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="login-left image-container">
                <img src="assets/header.jpeg" alt="Login Image" class="login-image">
            </div>
        </div>
    </div>

    <script>
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

            $(document).on('submit', '#ajaxLogin', function (e) {
                e.preventDefault()

                var formData = new FormData(this);
                formData.append("submit_ajaxLogin", true);

                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        var res = jQuery.parseJSON(response);

                        if (res.status == 100) {
                            window.location.href = 'clerk-dashboard.php';

                        } else if (res.status == 200) {
                            window.location.href = 'principal-dashboard.php';

                        } else if (res.status == 300) {
                            window.location.href = 'acc-dashboard.php';

                        } else if (res.status == 500) {
                            showError("Account Inactive");

                        }  else {
                            showError("Account does not exist");
                        }

                    }
                });

            });
        });
    </script>

</body>

</html>
