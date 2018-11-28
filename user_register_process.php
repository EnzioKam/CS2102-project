<?php
/**
 * This page processes registration details as given in user_register.php
 * User: hmxrswj
 * Date: 5/11/2018
 * Time: 12:40 PM
 */

require_once("includes/dbconf.php");

// get all posted data
$post_userName = $_POST["userName"];
$post_userId = $_POST["userId"];
$post_password = $_POST["password"];
$post_confirmPassword = $_POST["confirmPassword"];
$post_email = $_POST["email"];
$post_phoneNumber = $_POST["phoneNumber"];

// check 0: ensure that at a minimum userid, password and email are filled in
if (empty($post_userId) || empty($post_password) || empty($post_email)) {
    header("Location: user_register.php?status=blank_fields");
    exit();
}

// check 1: did user type password correctly both times?
if (strcmp($post_confirmPassword,$post_password) != 0) {
    header("Location: user_register.php?status=pswd_not_match&username=$post_userName&userid=$post_userId&email=$post_email&phone=$post_phoneNumber");
    exit;
}

// check 2: does user id already exist
// set up the db connection
$sql_checkUserIdExists = pg_query($db, "SELECT * FROM public.users WHERE userid = '$post_userId'");
if(pg_num_rows($sql_checkUserIdExists) > 0) {
    header("Location: user_register.php?status=userid_exists&username=$post_userName&email=$post_email&phone=$post_phoneNumber");
    exit;
}
// check 3: does email address already exist
// set up the db connection
$sql_checkEmailAddressExists = pg_query($db, "SELECT * FROM public.users WHERE email = '$post_email'");
if(pg_num_rows($sql_checkEmailAddressExists) > 0) {
    header("Location: user_register.php?status=email_exists&username=$post_userName&userid=$post_userId&phone=$post_phoneNumber");
    exit;
}

// if we get here, this means all checks have passed
// hash the password
$password_hash = password_hash($post_password, PASSWORD_DEFAULT);
// write the data to database
$sql_writeUserToDb = pg_query($db, "INSERT INTO users (userid, name, password, contactnum, email, isadmin) VALUES ('$post_userId', '$post_userName', '$password_hash', '$post_phoneNumber', '$post_email', false);");
header("Location: login.php?status=user_account_created")
?>