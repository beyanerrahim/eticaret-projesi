
<?php

error_reporting(false);

ob_start();
session_start();
$pageTitle='Edit profile';
include 'init.php';
include $tpl . 'navbar.php';
$bodybackground = 'body-login';
include $tpl.'header.php';
$pageTitle = 'Edit profile';

if (isset($_SESSION['email'])) {

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

if($do == 'Manage'){

}
elseif ($do == 'Edit') {

$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
$stmt = $con->prepare("SELECT * FROM users where UserID= ? limit 1");
$stmt->execute(array($userid));
$row = $stmt->fetch();
$count = $stmt->rowCount();

if ($count > 0) {

?>
  <div class="father-section">
    <div>
      <div class="container">
        <h2 class="edit-title text-center mb-4 mt-3">Edit Member </h2>
        <form action="?do=Update" class="" method="POST">
          <input type="hidden" name="userid" value="<?php echo $userid; ?>">
          <div class="row form-group edit-contant">
            <label for="" class="col-sm-2 contol-label">User Name :</label>
            <div class="col-sm-10 edit-input">
              <input type="text" name="username" class="form-control formcontrol" value="<?php echo $row['UserName'] ?>" autocomplete="off" required>
            </div>
          </div>
          <div class="row form-group edit-contant">
            <label for="" class="col-sm-2 contol-label">Email :</label>
            <div class="col-sm-10 edit-input">
              <input type="email" name="email" class="form-control formcontrol" value="<?php echo $row['Email'] ?>" required>
            </div>
          </div>
          <div class="row form-group edit-contant">
            <label for="" class="col-sm-2 contol-label">Password :</label>
            <div class="col-sm-10 edit-input">
              <input type="hidden" name="oldpassword" value="<?php echo $row['Password']; ?>">

              <input type="password" name="newpassword" class="form-control formcontrol" autocomplete="newpassword" placeholder="leave blank if you dont want to change">
            </div>
          </div>
          <div class="row form-group edit-contant">
            <label for="" class="col-sm-2 contol-label">Birthday :</label>
            <div class="col-sm-10 edit-input">
              <input type="date" name="birth" class="form-control formcontrol" value="<?php echo $row['Birthday'] ?>">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-10 ">
              <input type="submit" value="Save" class="btn btn-primary btn-save">
            </div>

          </div>

        </form>


      </div>
    </div>
  </div>
<?php
} else {
  echo "<div class='container'>";
  $themsg = '<div class="alert alert-danger">theres no such ID</div>';
  redirectHome($themsg);
  echo "</div>";
}
} elseif ($do == 'Update') { ?>
<div class="father-section">
  <div class="container">
    <h2 class="edit-title text-center mb-4">Update Member </h2>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //Get variables from the form
      $id = $_POST['userid'];
      $user = $_POST['username'];
      $email = $_POST['email'];
      $birth = $_POST['birth'];

      // password trick
      $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

      //validate the form

      $formerrors = array();

      if (strlen($user) < 4) {
        $formerrors[] = "<div class='alert alert-danger'>user name cant be less than<strong> 4 characters</strong> </div>";
      }
      if (strlen($user) > 25) {
        $formerrors[] = '<div class="alert alert-danger">user name cant be more than<strong> 25 characters</strong> </div>';
      }
      if (empty($user)) {
        $formerrors[] = '<div class="alert alert-danger">user name cant be empty</div>';
      }

      if (empty($email)) {
        $formerrors[] = '<div class="alert alert-danger">email cant be empty</div>';
      }
      foreach ($formerrors as $error) {
        echo $error;
      }
      //check if theres no error proced the update operation 
      if (empty($formerrors)) {

        $tmt2 = $con->prepare("SELECT * FROM users where UserName=? and UserID=? ");

        $tmt2->execute(array($user, $id));
        $count = $tmt2->rowCount();

      

          //Update the database with this Info
          $stmt = $con->prepare("UPDATE users set UserName = ?, Email = ?, Birthday = ? , Password =? where UserID = ?");
          $stmt->execute(array($user, $email, $birth, $pass, $id));


          $themsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' Record Updated</div>';
          redirectHome($themsg ,'profile.php');
      
      }
    } else {
      $errormsg = "<div class='alert alert-danger'>sorry you cant browser this page directly</div>";
      redirectHome($errormsg);
      //echo "sorry you cant browser this page directly";
    }

    ?>
  </div>
</div>
<?php

}}