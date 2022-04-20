<?php
error_reporting(false);
 session_start();
 $pageTitle='Login';
  include 'init.php';
  $bodybackground = 'body-login';
  include $tpl.'header.php';

//   if(isset($_SESSION['email'])){
    
//     header('Location: mainpage.php');
// }

?>


<?php
       //check if user coming form http post request

       if($_SERVER['REQUEST_METHOD']== 'POST'){
             $email = $_POST['email'];
        
             $password = $_POST['password'];
        
            $hashedpass = sha1($password);

            //check if the user exist in database

            $stmt = $con ->prepare("SELECT UserID,UserName,Password,Email,RoleID FROM users where Email = ? and Password = ? and RegStatus = 1 limit 1");
            $stmt->execute(array($email,$hashedpass));
            $row = $stmt->fetch();
           
            $count = $stmt->rowCount();
            
            //if  count > 0 this mean the database contain record about this username

            if($count  > 0){
               // echo "Welcome admin" . $username;
               $_SESSION['email'] = $email;
               $_SESSION['uid'] = $row['UserID'];     //register session uid
               $_SESSION['n'] = $row['UserName']; 

               if($row['RoleID'] == 1 ){
               header('Location: mainpage.php');
               }    //direct to dashboard page
               elseif($row['RoleID'] == 2){
                header('Location: admin/dashboard.php');
               }
               exit();
            }else{
              echo '<div class="container"><div class="text-center mt-2">Wrong Email or password  </div></div>';
            }
       }

?>
<section class="login-section">
        <div class="login">
            <form action="" method="POST">
            <div class="login-content">
                 <div class="login-form">
                    <h2 class="login-title text-center pb-3">Login Form</h2>
                    <div class="txt-field">
                    <label for="email" class="form-label ">Email :</label>
                   
                    <input type="email" class=" " name="email" autocomplete="off" placeholder="Enter Your Email">
                    </div>
                    <div class="txt-field">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" class=" " name="password" placeholder="Enter The Password">
                    </div>
                    <!-- <div class="mt-3">
                    Forgot Password ?<a href="checkemail.php" class="pass"> Click here</a>
                    </div> -->
                    <div>
                   <input type="submit" class="btn btn-primary text-center btn-login " value="Login"/>
                   </div>
                   <div class="signup-link">Not a Member ? <a href="register.php" class="signup">Sign Up</a></div>
                 </div>

            </div>
            </form>
        </div>

   </section>

   <?php
  include $tpl.'footer.php';
?>



