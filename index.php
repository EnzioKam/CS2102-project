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
                    <div class="jumbotron">
                        <?php
                        if ($status_code === "not_admin") {
                            echo "<div class=\"alert alert-danger\" role=\"alert\" id=\"trips_page_infobar\"><i class=\"fas fa-info-circle\"></i> You are not an admin, and cannot access this page.</div>";
                        }
                        ?>
                        <h1>Welcome to RideShare!</h1>
                        <p>You may log in or register by clicking in the link at the top right corner.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('template/footer.html'); ?>
    </body>
    <?php include_once('template/end_scripts.html'); ?>
</html>