<?php
error_reporting(false);
session_start();
$pageTitle='Register';
include 'init.php';
  $bodybackground = 'body-login';
  include $tpl.'header.php';
//   if(isset($_SESSION['email'])){
  
//     header('Location: mainpage.php');
//   }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $formErrors=array();

    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birth = $_POST['birthday'];
    $gender = $_POST['gender'];
    

    if(isset($username)){
          
      $filteruser = filter_var($username,FILTER_SANITIZE_STRING);
      if(strlen(($filteruser)) < 4){
        $formErrors[]='User Name Must Be Larger Than 4 characters';
      }
    }

    if(isset($email)){
          
      $filteremail = filter_var($email,FILTER_SANITIZE_EMAIL);
      if(filter_var($filteremail,FILTER_VALIDATE_EMAIL) != true){
        $formErrors[]='This Email Is Not valid';
      }
    }
    // if(! empty($formErrors)){
    // foreach ($formerrors as $error) {
    //   echo  $error ."merhababaabba";
    // }
    // }
    if(empty($formErrors)){

      $check = checkItem('UserName','users',$username);
      if($check == 1){
        $formErrors[] = 'Sorry This User is exists';
          

    }else{

     //insert user information in database       
     $stmt=$con->prepare("INSERT INTO users(UserName , `Password` ,Email ,Birthday , gender ,RegStatus,Date ,RoleID) VALUES(:user , :pass,:mail,:birth,:gender ,0,now(),1)" );
     $stmt->execute(array(
         'user' => $username,
         'pass' => sha1($password),
         'mail' => $email,
         'birth' => $birth,
         'gender' => $gender,
        
         
     ));
     $succesMsg = 'Cangrates You Are Now Registerd user';?>
     
     <div class="text-center">
     Hesabınız başarıyla kaydedildi, ancak hesabınıza giriş yapabilmek için yöneticinin onayını beklemeniz gerekiyor.
     </div>
     <?php
  }
   }
}

?>

<section class="login-section">
        <div class="login">
            <form action="" method="POST">
                <div class="login-content">
                    <div class="login-form">
                        <h2 class="login-title text-center pb-3">Register Form</h2>
                        <div class="txt-field">
                            <label for="name" class="form-label ">Full Name :</label>
                            <input type="text" class=" " id="name" name="name" autocomplete="off" placeholder="Enter Your Name" required>
                        </div>
                        <div class="txt-field">
                            <label for="email" class="form-label ">Email :</label>
                            <input type="email" class=" "id="email" name="email" autocomplete="off"
                                placeholder="Enter Your Email" required>
                        </div>
                        <div class="txt-field">
                            <label for="password" class="form-label">Password :</label>
                            <input type="password" class=" " id="password" name="password" placeholder="Enter The Password" required>
                        </div>
                        <div class="txt-field">
                            <label for="birthday" class="form-label">birthday :</label>
                            <input type="date" class=" " id="birthday" name="birthday" placeholder="Enter your birthday">
                        </div>
                        <div>
                            <label for="gender" class="my-1 mx-2 "> Gender :</label>
                            <input type="radio" value="male" name="gender" class="style-label" id="gender">
                            <span class="" style="font-size:18px">male</span>
                            <input type="radio" value="female" name="gender" class="style-label">
                            <span style="font-size:18px">female</span>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary text-center btn-login " value="register" />
                        </div>
                        
                        <div class="log-in-link">Do You Have an account? <a href="login.php" class="log-in">Log in</a></div>
                    </div>

                </div>
            </form>
        </div>

    </section>

    <?php
  include $tpl.'footer.php';
?>






