<?php
session_start();
require_once('includes/doLoginCheck.php');
require_once('includes/dbconf.php');
if ($_SESSION["ua_isLoggedIn"]) {
    // get http post request data
    $prName = $_POST["userName"];
    $prEmail = $_POST["email"];
    $prContactNumber = $_POST["phoneNumber"];
    
    // get session data
    $sessUserName = $_SESSION["ua_userId"];
    
    // perform the query
    $queryUpdateUserDetails = "UPDATE public.users SET name = '$prName', email = '$prEmail', contactnum = '$prContactNumber' WHERE userid = '$sessUserName';";
    pg_query($db, $queryUpdateUserDetails);
    
    // send user back to profile page
    header("Location: myprofile.php");
} else {
    // do nothing
}
?>
