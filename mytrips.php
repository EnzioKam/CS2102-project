<?php
session_start();
require_once('includes/dbconf.php');

if ($_SESSION["ua_isLoggedIn"]) {
    $session_userId = $_SESSION["ua_userId"];
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
                    <?php
                    if ($_GET["status"] === trip_deleted) {
                        echo "<div class=\"alert alert-success\" role\=\"alert\"><i class=\"fas fa-check\"></i> Trip has been successfully deleted!"
                        . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button></div>";
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-4">My Trips</h1>
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h4>Welcome back!</h4>
                    <div class="my-3"></div>
                    <p>This is your dashboard. You can see all the trips you've signed up for here.</p>
                    <p>To register for a new trip, click the "Find a Ride" link on the top navigation bar.</p>
                    <p>Have fun!</p>
                </div>
                <div class="col-lg-9">
                    <table class='table table-hover' border='1'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>Trip ID</th>
                                <th scope='col'>Start Location</th>
                                <th scope='col'>End Location</th>
                                <th scope='col'>Start Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT tp.tripid, t.startlocation, t.endlocation, t.tripstarttime 
                                FROM trippassenger tp, trip t 
                                WHERE tp.userid = '$session_userId' AND tp.tripid = t.tripid;";

                            $result = pg_query($db, $sql);  // Query template
                            $rows = pg_fetch_all($result);  // To store the result row
                            $num_rows = pg_num_rows($result);
                            // echo $num_rows . " row(s) returned.\n";


                            $i = 0;
                            while ($row = $rows[$i]) {
                                $tripId = $row['tripid'];
                                echo "<tr>";
                                echo "<td>" . $row['tripid'] . " <i class=\"fas fa-trash-alt\" onclick=\"location.href = 'doDeleteTrip.php?referrer=mytrips.php&tripid=$tripId'\"></i> ";
                                echo "<td>" . $row['startlocation'] . "</td>";
                                echo "<td>" . $row['endlocation'] . "</td>";
                                echo "<td>" . $row['tripstarttime'] . "</td>";
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <p><button type="button" class="btn btn-primary" onclick="location.href = 'trips.php';"><i class="fas fa-search"></i> Find a Trip</button>
</p>
                </div>
            </div>
        </div>
        <?php include_once('template/footer.html'); ?>
    </body>
    <?php include_once('template/end_scripts.html'); ?>
</html>