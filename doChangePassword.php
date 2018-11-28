<?php
session_start();
require_once("includes/doLoginCheck.php");
require_once("includes/dbconf.php");
if ($_SESSION["ua_isLoggedIn"]) {

    // setup variables
    $sessionUserId = $_SESSION["ua_userId"];
    $pdCurrentPassword = $_POST["currentPassword"];
    $pdNewPassword = $_POST["newPassword"];
    $pdConfirmPassword = $_POST["confirmPassword"];
    //print_r($_POST);

    // check if passwords are equal
    if ($pdNewPassword === $pdConfirmPassword && strlen($pdNewPassword) != 0 && strlen($pdConfirmPassword == 0)) {
        $isNewPasswordValid = true;
    } else {
        header("Location: changePassword.php?status=password_mismatch");
        exit();
    }

    // retrieve the current password from db
    $q1 = "SELECT * FROM public.users WHERE userid = '$sessionUserId'";
    $q1Result = pg_query($db, $q1);
    $q1ResultArray = pg_fetch_array($q1Result);
    print_r($q1ResultArray);

    // check current password
    if (password_verify($pdCurrentPassword, $q1ResultArray["password"])) {
        // hash the new password
        $newPassword = password_hash($pdNewPassword, PASSWORD_DEFAULT);
        // update the new password
        $q2 = "UPDATE public.users SET password = '$newPassword' WHERE userid = '$sessionUserId';";
        pg_query($db, $q2);
        header("Location: myprofile.php?status=password_changed");
    } else {
        header("Location: changePassword.php?status=password_incorrect");
        exit();
    }
}
?>