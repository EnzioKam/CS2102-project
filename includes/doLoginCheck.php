<?php
if ($_SESSION["ua_isLoggedIn"]) {
// do nothing
} else {
    header("Location: login.php?status=login_required");
}
?>