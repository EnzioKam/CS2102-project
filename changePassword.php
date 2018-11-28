<!DOCTYPE html>
<html>
    <head>
        <?php include_once('template/scripts.html'); ?>
    </head>
    <body>
        <?php include_once('template/navbar.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if ($_GET["status"] === password_mismatch) {
                        echo "<div class=\"alert alert-warning\" role\=\"alert\"><i class=\"fas fa-exclamation-triangle\"></i> Either your new passwords do not match, or you left a field blank. Please try again."
                        . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-4">Change Password</h1>
                    <hr/>
                    <p>Use this page to change your password.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action='doChangePassword.php' method='post'>
                        <div class='form-group'>
                            <input type='password' class='form-control' id='currentPassword' name='currentPassword' aria-describedby='passwordHelp' placeholder='Enter your existing password'>
                            <small id='passwordHelp' class='form-text text-muted'>This is to verify that you are who you are.</small>
                        </div>
                        <div class='form-group'>
                            <input type='password' class='form-control' id='newPassword' name='newPassword' aria-describedby='newPasswordHelp' placeholder='Enter your new password'>
                            <small id='newPasswordHelp' class='form-text text-muted'>A strong password consists of a mixture of lowercase letters, uppercase letters, and numbers.</small>
                        </div>
                        <div class='form-group'>
                            <input type='password' class='form-control' id='confirmPassword' name='confirmPassword' aria-describedby='confirmPasswordHelp' placeholder='Enter your new password again'>
                            <small id='confirmPasswordHelp' class='form-text text-muted'>Type the same password again to verify that you typed your password correctly.</small>
                        </div>
                        <button type='submit' class='btn btn-primary'><i class='fas fa-save'></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once('template/footer.html'); ?>
    </body>
    <?php include_once('template/end_scripts.html'); ?>
</html>