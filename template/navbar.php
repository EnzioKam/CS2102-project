<?php
session_start();
$session_userId = $_SESSION["ua_userId"];
echo "
<div class='navbar navbar-expand-lg navbar-dark bg-info' style='margin-bottom: 30px;'>
    <div class='container'>
        <a href='index.php' class='navbar-brand'>RideShare</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='true' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='navbar-collapse collapse show' id='navbarResponsive' style=''>
            <ul class='navbar-nav'>
            <li class='nav-item'>
                    <a class='nav-link' href='trips.php'>Find a Ride</a>
                </li>
            </ul>

            <ul class='nav navbar-nav ml-auto'>";

if ($_SESSION['ua_isAdmin']) {
    echo "<li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='navbarAdminDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class=\"fas fa-toolbox\"></i> Admin</a>
                    <div class='dropdown-menu' aria-labelledby='navbarAdminDropdown'>
                        <a class='dropdown-item' href='users.php'><i class=\"fas fa-users\"></i> User List</a>
                        <a class='dropdown-item' href='vehicles.php'><i class=\"fas fa-car\"></i> Vehicle List</a>
                    </div>
                </li>";
}

if ($_SESSION['ua_isLoggedIn']) {
    echo "<li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class=\"far fa-smile-wink\"></i> Hello, $session_userId!</a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <a class='dropdown-item' href='mytrips.php'><i class=\"fas fa-car\"></i> My Trips</a>
                        <a class='dropdown-item' href='myprofile.php'><i class=\"fas fa-user-circle\"></i> My Profile</a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='changePassword.php'><i class=\"fas fa-key\"></i> Change Password</a>
                        <a class='dropdown-item' href='logout.php'><i class=\"fas fa-sign-out-alt\"></i> Logout</a>
                    </div>
                </li>";
} else {
    echo "<li class='nav-item'>
                    <a class='nav-link' href='login.php'>Login or Register</a>
                </li>";
}

echo "</ul>
        </div>
    </div>
</div>";
?>