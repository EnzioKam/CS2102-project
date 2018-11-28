<?php
session_start();
require_once('includes/dbconf.php');

// get the username and password from post data
$post_username = $_POST["username"];
$post_password = $_POST["password"];


// check if the username & password combo exists in the directory
$login_correct = false;
$sql_checklogin = pg_query($db, "SELECT * FROM public.users WHERE userid = '$post_username'");

// if there is exactly 1 result that matches username and password hash, then we retrieve the database password.
if (pg_num_rows($sql_checklogin) == 1) {
    $result_arr = pg_fetch_array($sql_checklogin);
    if (password_verify($post_password, $result_arr["password"])) {
        $_SESSION["ua_isLoggedIn"] = true;
        $_SESSION["ua_userId"] = $result_arr['userid'];
        $result_isAdmin = $result_arr['isadmin'];
        if ($result_isAdmin === t) {
            $_SESSION["ua_isAdmin"] = TRUE;
        } else {
            $_SESSION["ua_isAdmin"] = FALSE;
        }
        $result_userName = $result_arr['name'];
        $login_correct = true;
    }
}

// perform redirection
if ($login_correct) {
    header("Location: mytrips.php");
}
else {
    header("Location: login.php?status=invalid_login");
}

?>