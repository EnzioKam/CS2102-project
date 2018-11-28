<?php
$status_code = $_GET["status"];
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once('template/scripts.html'); ?>
</head>
<body>
<?php include_once('template/navbar.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
                <h1 class="display-4">Login to RideShare</h1>
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            // write status to the infobar
            if ($status_code === "logout") {
                echo "<div class=\"alert alert-success\" role=\"alert\" id=\"login_page_infobar\"><i class=\"fas fa-info-circle\"></i> You have been logged out. Thank you for using RideShare!</div>";
            }
            if ($status_code === "user_account_created") {
                echo "<div class=\"alert alert-success\" role=\"alert\" id=\"login_page_infobar\"><i class=\"fas fa-info-circle\"></i> Your account has been successfully created! You may log in now.</div>";
            }
            else if ($status_code === "invalid_login") {
                echo "<div class=\"alert alert-danger\" role=\"alert\" id=\"login_page_infobar\"><i class=\"fas fa-info-circle\"></i> Whoops! You entered the wrong username or password.</div>";
            }
            else if ($status_code === "login_required") {
                echo "<div class=\"alert alert-warning\" role=\"alert\" id=\"login_page_infobar\"><i class=\"fas fa-info-circle\"></i> You need to be logged in to do that.</div>";
            }
            ?>
        </div>
        <div class="col-lg-6">
            <h2>Are you new?</h2>
            <p><br>It only takes 2 minutes to sign up. We promise.</p>
            <p><button type="button" class="btn btn-primary" onclick="location.href = 'user_register.php'"><i class="fas fa-user-plus"></i> Sign me up, Scotty!</button></ p>
        </div>
        <div class="col-lg-6">
            <h2>For returning users...</h2>
            <p><br>Great to see you again! Log in below.</p>
            <form action="doLogin.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" aria-describedby="passwordHelp" name="password" placeholder="Password">
                    <small id="passwordHelp" class="form-text text-muted">Forgot your password? We can help. Click <a href="#">here</a>.</small>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Log In</button>
            </form>
        </div>
    </div>
</div>
<?php include_once('template/footer.html'); ?>
</body>
<?php include_once('template/end_scripts.html'); ?>
</html>