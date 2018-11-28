<?php
// take the inputs via GET, just in case we need to redirect users back to this page
$get_userName = $_GET["username"];
$get_userId = $_GET["userid"];
$get_emailAddress = $_GET["email"];
$get_phoneNumber = $_GET["phone"];
$status_code = $_GET["status"];
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
                    <h1 class='display-4'>Create New Account</h1>
                    <hr />
                </div>
            </div>
            <div class='row'>
                <div class='container'>
                    <div class='col-lg-12'>
                        <p class='lead'>We're serious... this takes less than 2 minutes. Give it a shot!</p>
                        <?php
                        // status box, if necessary
                        if ($status_code === "pswd_not_match") {
                            echo "<div class=\"alert alert-danger\">The passwords you typed did not match. Please try again.</div>";
                        } else if ($status_code === "userid_exists") {
                            echo "<div class=\"alert alert-danger\">The user ID you specified has already been used. Please try another user ID.</div>";
                        } else if ($status_code === "email_exists") {
                            echo "<div class=\"alert alert-danger\">The email address you specified has already been used. Please try another email address.</div>";
                        } else if ($status_code === "blank_fields") {
                            echo "<div class=\"alert alert-danger\">You left some mandatory fields blank. Please check your input and submit again.</div>";
                        }
                        echo "
                <form action='user_register_process.php' method='post'>
                <div class='form-group'>
                        <input type='text' class='form-control' id='userName' name='userName' aria-describedby='userNameHelp' placeholder='Type your name' value='$get_userName'>
                        <small id='userNameHelp' class='form-text text-muted'>Let us know your name.</small>
                    </div>
                    <div class='form-group'>
                        <input type='text' class='form-control' id='userId' name='userId' aria-describedby='userIdHelp' placeholder='Choose a user ID*' value='$get_userId'>
                        <small id='userIdHelp' class='form-text text-muted'>Pick something easy to remember, but unique.</small>
                    </div>
                    <div class='form-group'>
                        <input type='password' class='form-control' id='password' name='password' aria-describedby='pswdHelp' placeholder='Create a password*'>
                        <small id='pswdHelp' class='form-text text-muted'>A strong password consists of a mixture of lowercase letters, uppercase letters, and numbers.</small>
                    </div>
                    <div class='form-group'>
                        <input type='password' class='form-control' id='confirmPassword' name='confirmPassword' aria-describedby='confirmPasswordHelp' placeholder='Confirm password*'>
                        <small id='confirmPasswordHelp' class='form-text text-muted'>Just to confirm that you've entered your password correctly.</small>
                    </div>
                    <div class='form-group'>
                        <input type='email' class='form-control' id='email' name='email' aria-describedby='emailHelp' placeholder='Enter your email address*' value='$get_emailAddress'>
                        <small id='emailHelp' class='form-text text-muted'>You agree that we may send you promos and offers. You may opt out at any time.</small>
                    </div>
                    <div class='form-group'>
                        <input type='tel' class='form-control' id='phoneNumber' name='phoneNumber' aria-describedby='phoneNumberHelp' placeholder='Enter your mobile number' value='$get_phoneNumber'>
                        <small id='phoneNumberHelp' class='form-text text-muted'>No ads! We only use your mobile phone to update you on urgent matters.</small>
                    </div>
                    <button type='submit' class='btn btn-primary'><i class='fas fa-user-plus'></i> Create My Account</button>
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