<?php
error_reporting(false);
$pageTitle='Reset password';
  include 'init.php';
  $bodybackground = 'body-login';
  include $tpl.'header.php';

?>

<section class="login-section">
        <div class="login">
            <form action="" method="POST">
            <div class="login-content">
                 <div class="login-form">
                    <h2 class="login-title text-center pb-3">Reset The Password Form</h2>
                    <div class="txt-field">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class=" " name="password" placeholder="Enter Password">
                    </div>
                    <div class="txt-field">
                    <label for="password1" class="form-label">Password repeat :</label>
                    <input type="password" class=" " name="password1" placeholder="Enter Password again">
                    </div>            
                    <div>
                   <input type="submit" class="btn btn-primary text-center btn-login mt-4 " value="Reset Password"/>
                   </div>
                 </div>

            </div>
            </form>
        </div>

   </section>
<?php
  include $tpl.'footer.php';
?>





