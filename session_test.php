<?php
/**
 * Created by PhpStorm.
 * User: hmxrswj
 * Date: 5/11/2018
 * Time: 11:48 AM
 */
session_start();
$session_isLoggedIn = $_SESSION["ua_isLoggedIn"];
$session_userId = $_SESSION["ua_userId"];
echo "Login status: $session_isLoggedIn <br /> User ID: $session_userId <br />";
print_r($_SESSION);
?>