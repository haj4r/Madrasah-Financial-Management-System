<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .sidebar {
        width: 230px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: black;
        color: white;
    }

    .sidebar .logo {
        text-align: left;
        padding-left: 20px;
        padding-top: 20px;
        color: white;

    }

    .sidebar .logo h3 {
        font-weight: bold;
        padding-left: 10px;
        font-size: 18px;

    }

    .sidebar .logo img {
        width: 100px;
    }

    .sidebar .nav-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .sidebar .nav-list li {
        padding: 10px;
    }

    .sidebar .nav-list li a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .sidebar .nav-list li a.active {
        font-weight: bold;
        background-color: #A9DFD8;
        color: black;
    }

    .sidebar .nav-list li a:hover {
        font-weight: bold;
        background-color: #A9DFD8;
        color: black;
    }

    .navbar {
        display: none;
        padding: 10px 20px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 999;
        align-items: center;
        justify-content: space-between;
        background-color: white;
        border-bottom: 1px solid black;
    }

    .navbar .hamburger {
        background: none;
        border: none;
        color: black;
        font-size: 24px;
        cursor: pointer;
    }

    .navbar .icon-menu::before {
        content: "\2630";
    }

    .navbar .nav-list {
        display: none;
        flex-direction: column;
        list-style-type: none;
        padding: 20px 10px;
        margin: 0;
        width: 100%;
        background-color: #3D3D3D;
        position: fixed;
        top: 50px;
        left: 0;
        z-index: 998;
    }

    .navbar .nav-list li {
        padding: 10px;
    }

    .navbar .nav-list li a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px 5px;
        border-radius: 5px;
    }

    .navbar .nav-list li a.active {
        background-color: #A9DFD8;
        color: black;
    }

    @media (max-width: 425px) {
        .sidebar {
            display: none;
        }

        .navbar {
            display: flex;
        }

        .navbar .nav-list {
            display: none;
        }

        .navbar .nav-list.active {
            display: flex;
        }
    }
</style>

<script src="https://kit.fontawesome.com/d21aa4c3aa.js" crossorigin="anonymous"></script>
<script>
    // JavaScript to handle setting the active class based on the current page URL
    document.addEventListener('DOMContentLoaded', function () {
        var currentPath = window.location.pathname;
        var navLinks = document.querySelectorAll('.nav-list a');

        navLinks.forEach(function (link) {
            if (link.href.includes(currentPath)) {
                link.classList.add('active');
            }
        });
    });

    // JavaScript for mobile menu toggle
    // document.querySelector('.hamburger').addEventListener('click', function () {
    //     document.querySelector('.navbar .nav-list').classList.toggle('active');
    // });
</script>

<?php
include 'dbConnection.php';

$query = "SELECT * FROM LOGIN WHERE login_id = '" . $_SESSION['login_id'] . "'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $category = $row['category'];
    }
}

if ($category == 'Clerk') {
    echo '
<div class="sidebar">
    <div class="logo">
       <h3 class="has-text-weight-semibold">Madrasah Financial</h3>
    </div>
    <ul class="nav-list is-size-7">
        <li><a href="clerk-dashboard.php"><i class="fa fa-home mx-2"></i> Dashboard</a></li>
         <li><a href="clerk-profile.php"><i class="fa fa-user mx-2"></i> User Profile</a></li>
        <li><a href="users.php"><i class="fa fa-users mx-2"></i> Add Users</a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out-alt mx-2"></i> Sign Out</a></li>
    </ul>
</div>

<div class="navbar">
    <button class="hamburger"><i class="icon-menu" style="font-style:normal;"></i></button>
    <ul class="nav-list is-size-7">
          <li><a href="clerk-dashboard.php"><i class="fa fa-home mx-2"></i> Dashboard</a></li>
         <li><a href="clerk-profile.php"><i class="fa fa-user mx-2"></i> User Profile</a></li>
        <li><a href="users.php"><i class="fa fa-users mx-2"></i> Add Users</a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out-alt mx-2"></i> Sign Out</a></li>
    </ul>
</div>';

} else if ($category == 'Principal') {
    echo '
<div class="sidebar">
    <div class="logo">
       <h3>Madrasah Financial</h3>
    </div>
    <ul class="nav-list is-size-7">
        <li><a href="principal-dashboard.php"><i class="fa fa-home mx-2"></i> Dashboard</a></li>
         <li><a href="principal-profile.php"><i class="fa fa-user mx-2"></i> User Profile</a></li>
         <li><a href="list-clerk.php"><i class="fa fa-users mx-2"></i> Clerk List</a></li>
         <li><a href="principal-report.php"><i class="fa fa-window-restore mx-2"></i> Report</a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out-alt mx-2"></i> Sign Out</a></li>
    </ul>
</div>

<div class="navbar">
    <button class="hamburger"><i class="icon-menu" style="font-style:normal;"></i></button>
    <ul class="nav-list is-size-7">
         <li><a href="principal-dashboard.php"><i class="fa fa-home mx-2"></i> Dashboard</a></li>
         <li><a href="clerk-profile.php"><i class="fa fa-user mx-2"></i> User Profile</a></li>
        <li><a href="list-clerk.php"><i class="fa fa-users mx-2"></i> Clerk List</a></li>
         <li><a href="principal-report.php"><i class="fa fa-window-restore mx-2"></i> Report</a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out-alt mx-2"></i> Sign Out</a></li>
    </ul>
</div>';

} else {
    echo '
<div class="sidebar">
    <div class="logo">
       <h3>Madrasah Financial</h3>
    </div>
    <ul class="nav-list is-size-7">
        <li><a href="acc-dashboard.php"><i class="fa fa-home mx-2"></i> Dashboard</a></li>
         <li><a href="acc-profile.php"><i class="fa fa-user mx-2"></i> User Profile</a></li>
        <li><a href="transaction.php"><i class="fa fa-book mx-2"></i> Transaction</a></li>
        <li><a href="led_zakat.php"><i class="fa fa-file mx-2"></i> Zakat Ledger</a></li>
        <li><a href="led_donation.php"><i class="fa fa-file mx-2"></i> Donation Ledger</a></li>
        <li><a href="led_fees.php"><i class="fa fa-file mx-2"></i> Fees Ledger</a></li>
         <li><a href="acc-report.php"><i class="fa fa-window-restore mx-2"></i> Report</a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out-alt mx-2"></i> Sign Out</a></li>
    </ul>
</div>

<div class="navbar">
    <button class="hamburger"><i class="icon-menu" style="font-style:normal;"></i></button>
    <ul class="nav-list is-size-7">
       <li><a href="acc-dashboard.php"><i class="fa fa-home mx-2"></i> Dashboard</a></li>
         <li><a href="acc-profile.php"><i class="fa fa-user mx-2"></i> User Profile</a></li>
        <li><a href="transaction.php"><i class="fa fa-book mx-2"></i> Transaction</a></li>
        <li><a href="led_zakat.php"><i class="fa fa-file mx-2"></i> Zakat Ledger</a></li>
        <li><a href="led_donation.php"><i class="fa fa-file mx-2"></i> Donation Ledger</a></li>
        <li><a href="led_fees.php"><i class="fa fa-file mx-2"></i> Fees Ledger</a></li>
         <li><a href="acc-report.php"><i class="fa fa-window-restore mx-2"></i> Report</a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out-alt mx-2"></i> Sign Out</a></li>
    </ul>
</div>';

}

?>