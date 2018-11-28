<?php
/**
 * Created by PhpStorm.
 * User: ENZIO
 * Date: 6/11/2018
 * Time: 12:54 AM
 */

session_start();
require_once('includes/dbconf.php');

if ($_SESSION["ua_isLoggedIn"]) {
    $session_userId = $_SESSION["ua_userId"];
}
else {
    header("Location: login.php?status=login_required");
}

$id = $_GET['id'];


if ($session_userId) {
    $sql = "INSERT INTO trippassenger (tripid, userid) VALUES('$id', '$session_userId')";
    $result = pg_query($db, $sql);
}

echo "<script>";
if ($result) {
    echo "window.location.href='trips.php?status=success';";
}
else {
    echo "window.location.href='trips.php?status=failure';";
}
echo "</script>";

?>