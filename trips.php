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
                    <h1 class="display-4">Find A Ride</h1>
                    <hr/>
                </div>
                <div class="col-lg-12">
                    <?php
                    if ($status_code === "success") {
                        echo "<div class=\"alert alert-success\" role=\"alert\" id=\"trips_page_infobar\"><i class=\"fas fa-info-circle\"></i> You have successfully registered for the trip!</div>";
                    }
                    if ($status_code === "failure") {
                        echo "<div class=\"alert alert-warning\" role=\"alert\" id=\"trips_page_infobar\"><i class=\"fas fa-info-circle\"></i> You failed to register for the trip.</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h5>Enter your search terms here: </h5>
                    <div class="my-3"></div>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="location" class="form-control"
                                   placeholder="Enter Start or End Location">
                        </div>
                        <div class="form-group">
                            <input type="number" name="min-price" class="form-control"
                                   placeholder="Enter Min Price">
                        </div>
                        <div class="form-group">
                            <input type="number" name="max-price" class="form-control"
                                   placeholder="Enter Max Price">
                        </div>
                        <label class="control-label" for="start-date">Enter Earliest Start Date and Time</label>
                        <div class="form-group">
                            <input type="datetime-local" name="start-date" class="form-control" id="start-date">
                        </div>
                        <label class="control-label" for="end-date">Enter Latest Start Date and Time</label>
                        <div class="form-group">
                            <input type="datetime-local" name="end-date" class="form-control" id="end-date">
                        </div>
                        <div class="form-group">
                            <input type="text" name="driver-id" class="form-control"
                                   placeholder="Enter Driver's UserID">
                        </div>
                        <div class="form-group">
                            <input type="text" name="vehicle-num" class="form-control"
                                   placeholder="Enter Vehicle Plate Number">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Submit</button>
                    </form>
                </div>
                <div class="col-lg-9">
                    <table class='table table-hover' style="word-wrap:break-word; word-break:break-all;">
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>ID</th>
                                <th scope='col'>Start</th>
                                <th scope='col'>End</th>
                                <th scope='col'>Departs</th>
                                <th scope='col'>Arrives</th>
                                <th scope='col'>Bid End</th>
                                <th scope='col'>$</th>
                                <th scope='col'>...</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            require_once('includes/dbconf.php');

                            if ($_SESSION["ua_isLoggedIn"]) {
                                $curr_user = $_SESSION["ua_userId"];
                            } else {
                                $curr_user = "";
                            }

                            $location = ($_REQUEST['location']);
                            $min_price = ($_REQUEST['min-price']);
                            if (!$min_price) {
                                $min_price = 0;
                            }
                            $max_price = ($_REQUEST['max-price']);
                            if (!$max_price) {
                                $max_price = PHP_INT_MAX;
                            }
                            $start_date = date('Y-m-d H:i:s', strtotime($_REQUEST['start-date']));
                            $end_date = date('Y-m-d H:i:s', strtotime($_REQUEST['end-date']));
                            if ($end_date == date('Y-m-d H:i:s', strtotime("1969-12-31 16:00:00"))) {
                                $end_date = date('Y-m-d H:i:s', strtotime("2030-12-31 16:00:00"));
                            }

                            $driver = ($_REQUEST['driver-id']);
                            $vehicle = ($_REQUEST['vehicle-num']);
                            if (!$driver && !$vehicle) {
                                $sql = "SELECT * FROM trip WHERE (startlocation LIKE '%" . $location . "%' 
                                    OR endlocation LIKE '%" . $location . "%') AND 
                                    '$min_price' <= price AND price <= '$max_price'
                                    AND '$start_date' <= tripstarttime
                                    AND '$end_date' >= tripstarttime";
                            }
                            elseif (!$vehicle) {
                                $sql = "SELECT t.tripid, t.startlocation, t.endlocation, t.tripstarttime, t.tripendtime, t.bidstarttime,
                                    t.bidendtime, t.price FROM trip t, tripdetail td 
                                    WHERE td.driverid = '$driver' AND td.tripid = t.tripid
                                    AND (t.startlocation LIKE '%" . $location . "%' 
                                    OR t.endlocation LIKE '%" . $location . "%') AND 
                                    '$min_price' <= t.price AND t.price <= '$max_price'
                                    AND '$start_date' <= t.tripstarttime
                                    AND '$end_date' >= t.tripstarttime";
                            }
                            elseif (!$driver) {
                                $sql = "SELECT t.tripid, t.startlocation, t.endlocation, t.tripstarttime, t.tripendtime, t.bidstarttime,
                                    t.bidendtime, t.price FROM trip t, tripdetail td 
                                    WHERE td.vehicleplatenum = '$vehicle' AND td.tripid = t.tripid
                                    AND (t.startlocation LIKE '%" . $location . "%' 
                                    OR t.endlocation LIKE '%" . $location . "%') AND 
                                    '$min_price' <= t.price AND t.price <= '$max_price'
                                    AND '$start_date' <= t.tripstarttime
                                    AND '$end_date' >= t.tripstarttime";
                            }
                            else {
                                $sql = "SELECT t.tripid, t.startlocation, t.endlocation, t.tripstarttime, t.tripendtime, t.bidstarttime,
                                    t.bidendtime, t.price FROM trip t, tripdetail td 
                                    WHERE td.driverid = '$driver' AND td.tripid = t.tripid
                                    AND td.vehicleplatenum = '$vehicle' AND td.tripid = t.tripid
                                    AND (t.startlocation LIKE '%" . $location . "%' 
                                    OR t.endlocation LIKE '%" . $location . "%') AND 
                                    '$min_price' <= t.price AND t.price <= '$max_price'
                                    AND '$start_date' <= t.tripstarttime
                                    AND '$end_date' >= t.tripstarttime";
                            }

                            $r_query = pg_query($db, $sql);
                            while ($row = pg_fetch_array($r_query)) {
                                echo "<tr>";
                                echo "<td>" . $row['tripid'] . "</td>";
                                echo "<td>" . $row['startlocation'] . "</td>";
                                echo "<td>" . $row['endlocation'] . "</td>";
                                echo "<td>" . $row['tripstarttime'] . "</td>";
                                echo "<td>" . $row['tripendtime'] . "</td>";
                                echo "<td>" . $row['bidendtime'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td><a class='btn btn-primary' href='registertrip.php?id=" . $row['tripid'] . "'>register</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php include_once('template/footer.html'); ?>
    </body>
    <?php include_once('template/end_scripts.html'); ?>
</html>