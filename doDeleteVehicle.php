<?php
session_start();
require_once("includes/dbconf.php");
if ($_SESSION["ua_isLoggedIn"]) {
    
    // get variables from get request
    $getReqReferrer = $_GET["referrer"];
    $getReqVehicle = $_GET["vehicle"];
    // get variables from session
    $currentUser = $_SESSION["ua_userId"];
    
    // perform the sql query to delete the vehicle
    $queryDeleteLinkedVehicle = "DELETE FROM public.joinusersvehicle WHERE userid = '$currentUser' AND platenum = '$getReqVehicle';";
    $queryDeleteVehicle = "DELETE FROM public.vehicle WHERE platenum = '$getReqVehicle';";
    pg_query($db, $queryDeleteLinkedVehicle);
    pg_query($db, $queryDeleteVehicle);
    
    // redirect the user back to the page he came from
    header("Location: $getReqReferrer?status=vehicle_deleted");
    
} else {
    header("Location: login.php?status=login_required");
}
?>

