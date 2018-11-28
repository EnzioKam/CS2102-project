<?php
session_start();
require_once('includes/dbconf.php');

if ($_SESSION["ua_isLoggedIn"]) {
    $session_userId = $_SESSION["ua_userId"];
} else {
    $session_userId = "";
}

$sql = "SELECT * FROM users WHERE userid = '$session_userId';";

$result = pg_query($db, $sql);  // Query template
$rows = pg_fetch_all($result);  // To store the result row
$num_rows = pg_num_rows($result);
// echo $num_rows . " row(s) returned.\n";
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
                    <?php
                    if ($_GET["status"] === vehicle_registered) {
                        echo "<div class=\"alert alert-success\" role\=\"alert\"><i class=\"fas fa-check\"></i> Vehicle successfully registered!"
                        . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button></div>";
                    } else if ($_GET["status"] === vehicle_deleted) {
                        echo "<div class=\"alert alert-success\" role\=\"alert\"><i class=\"fas fa-check\"></i> Vehicle successfully deleted!"
                        . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button></div>";
                    } else if ($_GET["status"] === password_changed) {
                        echo "<div class=\"alert alert-success\" role\=\"alert\"><i class=\"fas fa-check\"></i> Your password was successfully changed."
                        . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button></div>";
                    }
                    ?>
                    <h1 class="display-4">My Profile</h1>
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h4>Here's what we know.</h4>
                    <div class='my-3'></div>
                    <p>This is all the information we have about you.</p>
                    <p>To modify the information, click edit where appropriate.</p>
                </div>
                <div class="col-lg-9">
                    <h2>User Details</h2>
                    <table class='table table-hover' border='1'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>User ID</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Contact Number</th>
                                <th scope='col'>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            while ($row = $rows[$i]) {
                                echo "<tr>";
                                echo "<td>" . $row['userid'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['contactnum'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <p>
                        <button type="button" class="btn btn-primary" onclick="location.href = 'editUserDetails.php';"><i class="fas fa-edit"></i> Edit My Information</button>
                    </p>
                    <h2>Registered Vehicles</h2>
                    <table class='table table-hover' border='1'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>Plate Number</th>
                                <th scope='col'>Capacity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql2 = "SELECT j.platenum, v.capacity FROM joinusersvehicle j, vehicle v 
                WHERE j.platenum = v.platenum AND userid = '$session_userId';";

                            $result = pg_query($db, $sql2);
                            $rows = pg_fetch_all($result);
                            $num_rows = pg_num_rows($result);


                            $i = 0;
                            while ($row = $rows[$i]) {
                                $platenum = $row['platenum'];
                                echo "<tr>";
                                echo "<td>" . $platenum . " <i class=\"fas fa-trash-alt\" onclick=\"location.href = 'doDeleteVehicle.php?referrer=myprofile.php&vehicle=$platenum'\"></i> </td>";
                                echo "<td>" . $row['capacity'] . "</td>";
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <p>
                        <button type="button" class="btn btn-primary" onclick="location.href = 'addvehicle.php'"><i class="fas fa-plus-square"></i> Add a Vehicle</button>
                    </p>
                </div>
            </div>
        </div>
        <?php include_once('template/footer.html'); ?>
    </body>
    <?php include_once('template/end_scripts.html'); ?>
</html>