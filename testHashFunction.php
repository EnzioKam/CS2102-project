<?php
/**
 * Created by PhpStorm.
 * User: hmxrswj
 * Date: 5/11/2018
 * Time: 11:21 AM
 */

$pswdToHash = "password";
$pswdHashed = password_hash($pswdToHash, PASSWORD_DEFAULT);

echo $pswdHashed;
?>