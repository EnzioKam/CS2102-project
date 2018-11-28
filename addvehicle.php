<?php
session_start();

require_once('includes/dbconf.php');

if ($_SESSION["ua_isLoggedIn"]) {
    $session_userId = $_SESSION["ua_userId"];
    $plate_num = ($_REQUEST['plate-number']);
    $capacity = ($_REQUEST['capacity']);

    $sql = "INSERT INTO vehicle (platenum, capacity) VALUES ('$plate_num','$capacity');";

    $result = pg_query($db, $sql);
    if ($result) {
        pg_query($db, "INSERT INTO joinusersvehicle (userid, platenum) values ('$session_userId', '$plate_num');");
        header("Location: myprofile.php?status=vehicle_registered");
    }
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
        <div class="container">
            <div class="row">
                <div class="col-lg-12"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-4">Add new Vehicle</h1>
                    <hr/>
                    <form class="col-6" action="" method="post">
                        <div class="form-group">
                            <input type="text" name="plate-number" class="form-control"
                                   placeholder="Enter vehicle plate number">
                        </div>
                        <div class="form-group">
                            <input type="number" name="capacity" class="form-control"
                                   placeholder="Enter vehicle capacity">
                        </div>
                        <input class="btn btn-primary btn-lg" type="submit" value="Register Vehicle" />
                    </form>
                </div>
            </div>
        </div>
<?php include_once('template/footer.html'); ?>
    </body>
        <?php include_once('template/end_scripts.html'); ?>
</html>