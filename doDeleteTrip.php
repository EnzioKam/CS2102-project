<?php
session_start();
require_once("includes/dbconf.php");
if ($_SESSION["ua_isLoggedIn"]) {
    
    // get variables from get request
    $getReqReferrer = $_GET["referrer"];
    $getTripId = $_GET["tripid"];
    // get variables from session
    $currentUser = $_SESSION["ua_userId"];
    
    // perform the sql query to delete the vehicle
    $queryDeleteTrip = "DELETE FROM public.trippassenger WHERE userid = '$currentUser' AND tripid = '$getTripId';";
    echo $queryDeleteTrip;
    pg_query($db, $queryDeleteTrip);
    
    // redirect the user back to the page he came from
    header("Location: $getReqReferrer?status=trip_deleted");
    
    
} else {
    header("Location: login.php?status=login_required");
}
?>

