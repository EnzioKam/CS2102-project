<?php

/* Show all errors - uncomment the 3 lines below if you want to show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// This file contains the database settings/configuration for the project files.
// In future, just use require_once("includes/dbconf.php")

$db = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=theory1!2");

?>