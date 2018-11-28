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
            <h1 class="display-4">Users</h1>
            <hr/>

            <?php

            $result = pg_query($db, "SELECT * FROM users");		// Query template
            $rows    = pg_fetch_all($result);		// To store the result row
            $num_rows = pg_num_rows($result);
            // echo $num_rows . " row(s) returned.\n";

            echo "<table class='table table-hover' border='1'> <thead class='thead-light'>
                <tr>
                <th scope='col'>userID</th>
                <th scope='col'>name</th>
                <th scope='col'>email</th>
                </tr> </thead>";

            echo "<tbody>";
            $i = 0;
            while($row = $rows[$i]) {
                echo "<tr>";
                echo "<td>" . $row['userid'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
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