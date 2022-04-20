<?php
error_reporting(false);
  session_start();
  $nonavbar = '';
  $pageTitle = 'Login';
  include 'init.php';
  
?>

<?php
       //check if user coming form http post request

       if($_SERVER['REQUEST_METHOD']== 'POST'){
             $username = $_POST['user'];
             $password = $_POST['pass'];
        
            $hashedpass = sha1($password);

            //check if the user exist in database

            $stmt = $con ->prepare("SELECT UserID,UserName,Password FROM users where UserName = ? and Password = ? and RoleID=2 limit 1");
            $stmt->execute(array($username,$hashedpass));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            
            //if  count > 0 this mean the database contain record about this username

            if($count  > 0){
               // echo "Welcome admin" . $username;
               $_SESSION['Username'] = $username;    //register session name
               $_SESSION['ID'] = $row['UserID'];     //register session ID

               header('Location: dashboard.php');    //direct to dashboard page
               exit();
            }
       }

?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
    <h4 class="text-center">Admin Login Form</h4>
    <input class="form-control " type="text" name="user" placeholder="user name" autocomplete="off"/>
    <input class="form-control " type="password" name="pass" placeholder="password" autocomplete="new-password"/>
    <input class="btn btn-primary btn-block" type="submit" value="login"/>

</form>


<?php
  include $tpl.'footer.php';
?>