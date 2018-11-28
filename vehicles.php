<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    include_once('template/scripts.html');
    require_once('includes/dbconf.php');

    if ($_SESSION["ua_isLoggedIn"]) {
        $session_userId = $_SESSION["ua_userId"];
        $check_exists = pg_query($db,
            "SELECT userid FROM users WHERE userid='$session_userId' AND isadmin = true;");
        if (pg_num_rows($check_exists) < 1) {
            header("Location: index.php?status=not_admin");
        }
    }
    else {
        header("Location: index.php?status=not_admin");
    }
    ?>
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
            <h1 class="display-4">Vehicles</h1>
            <hr/>
            <form action="" method="post">
                <div class="form-group">
                    <input type="number" name="min-cap" class="form-control"
                           placeholder="Enter Min Capacity">
                </div>
                <div class="form-group">
                    <input type="number" name="max-cap" class="form-control"
                           placeholder="Enter Max Capacity">
                </div>
                <input type="submit" value="Submit" />
            </form>

            <?php

            $min_cap = ($_REQUEST['min-cap']);
            if (!$min_cap) {
                $min_cap = 0;
            }
            $max_cap = ($_REQUEST['max-cap']);
            if (!$max_cap) {
                $max_cap = 100; //cap on 100 size vehicle
            }

            $sql = "SELECT j.userid, v.platenum, v.capacity FROM vehicle v, joinusersvehicle j 
                WHERE j.platenum = v.platenum AND '$min_cap' <= capacity AND capacity <= '$max_cap'";

            $result = pg_query($db, $sql);		// Query template
            $rows    = pg_fetch_all($result);		// To store the result row
            $num_rows = pg_num_rows($result);
            // echo $num_rows . " row(s) returned.\n";

            echo "<table class='table table-hover' border='1'> <thead class='thead-light'>
                <tr>
                <th scope='col'>Driver</th>
                <th scope='col'>Vehicle Plate No.</th>
                <th scope='col'>Max Capacity</th>
                </tr> </thead>";

            echo "<tbody>";
            $i = 0;
            while($row = $rows[$i]) {
                echo "<tr>";
                echo "<td>" . $row['userid'] . "</td>";
                echo "<td>" . $row['platenum'] . "</td>";
                echo "<td>" . $row['capacity'] . "</td>";
                echo "</tr>";
                $i++;
            }
            echo "</tbody>";
            echo "</table>";
            ?>

        </div>
    </div>
</div>
<?php include_once('template/footer.html'); ?>
</body>
<?php include_once('template/end_scripts.html'); ?>
</html>