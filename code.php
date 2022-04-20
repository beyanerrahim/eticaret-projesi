<?php
error_reporting(false);
$pageTitle='Code';
  include 'init.php';
  $bodybackground = 'body-login';
  include $tpl.'header.php';
?>

<section class="login-section">
        <div class="login">
            <form action="" method="POST">
            <div class="login-content">
                 <div class="login-form">
                    <h2 class="login-title text-center pb-3">Code Check Page </h2>
                    <div class="txt-field">
                    <label for="code" class="form-label ">Code :</label>               
                    <input type="text" class=" " name="code" id="code "autocomplete="off" placeholder="Enter The Code">
                    </div>
            
                    <div>
                   <input type="submit" class="btn btn-primary text-center btn-login  mt-5" value="Check"/>
                   </div>
                 </div>

            </div>
            </form>
        </div>

   </section>

   <?php
  include $tpl.'footer.php';
?>
