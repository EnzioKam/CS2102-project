<?php
session_start();
require_once('includes/dbconf.php');
if ($_SESSION["ua_isLoggedIn"]) {
    $currentUserName = $_SESSION["ua_userId"];

    // get required info from db
    $q1 = "SELECT * FROM public.users WHERE userid = '$currentUserName'";
    $q1Result = pg_query($db, $q1);
    $q1ResultArray = pg_fetch_array($q1Result);
} else {
    header("Location: login.php?status=login_required");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once('template/scripts.html'); ?>
    </head>
    <body>
        <?php include_once('template/navbar.php'); ?>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'></div>
            </div>
        </div>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='display-4'>Edit User Details</h1>
                    <hr />
                </div>
            </div>
            <div class='row'>
                <div class='container'>
                    <div class='col-lg-12'>
                        <p class='lead'>Modify the details as you deem fit, then click submit.</p>
                        <?php
                        echo "
                <form action='doEditUserDetails.php' method='post'>
                <div class='form-group'>
                <label for=\"userName\">Your Name:</label>
                        <input type='text' class='form-control' id='userName' name='userName' aria-describedby='userNameHelp' placeholder='Type your name' value='" . $q1ResultArray["name"] . "'>
                    </div>
                    <div class='form-group'>
                    <label for=\"email\">Your Email Address:</label>
                        <input type='email' class='form-control' id='email' name='email' aria-describedby='emailHelp' placeholder='Enter your email address' value='" . $q1ResultArray["email"] . "'>
                    </div>
                    <div class='form-group'>
                    <label for=\"phoneNumber\">Your Mobile Number:</label>
                        <input type='tel' class='form-control' id='phoneNumber' name='phoneNumber' aria-describedby='phoneNumberHelp' placeholder='Enter your mobile number' value='" . $q1ResultArray["contactnum"] . "'>
                    </div>
                    <button type='submit' class='btn btn-primary'><i class='fas fa-save'></i> Save Changes</button>
                </form>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('template/footer.html'); ?>
    </body>
    <?php include_once('template/end_scripts.html'); ?>
</html>