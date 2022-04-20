<?php
error_reporting(false);
$pageTitle='Check Email';
  include 'init.php';
  $bodybackground = 'body-login';
  include $tpl.'header.php';
  
?>



<section class="login-section">
        <div class="login">
            <form action="" method="POST">
            <div class="login-content">
                 <div class="login-form">
                    <h2 class="login-title text-center pb-3">Check Email Form</h2>
                    <div class="txt-field">
                    <label for="email" class="form-label ">Email :</label>
                   
                    <input type="text" class=" " name="email" autocomplete="off" placeholder="Enter Your Email">
                    </div>
            
                    <div>
                   <input type="submit" class="btn btn-primary text-center btn-login  mt-5" value="Check the Email"/>
                   </div>
                 </div>

            </div>
            </form>
        </div>

   </section>
   <?php
  include $tpl.'footer.php';
?>
