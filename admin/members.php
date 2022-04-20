<?php

/* members page */
error_reporting(false);
ob_start();
session_start();

$pageTitle = 'Members';

if (isset($_SESSION['Username'])) {

  include 'init.php';

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  if ($do == 'Manage') {

    $query ='';
    if(isset($_GET['page']) && $_GET['page'] == 'Pending'){
      $query = 'AND RegStatus = 0';
    }

        $stmt=$con->prepare("SELECT * FROM users where RoleID != 2 $query order by UserID DESC");
        $stmt->execute();

        //assaign to varible
        $rows = $stmt->fetchAll();

        //if(! empty( $rows)){
?>
    <div class="table-member">
      <div class="t-content">
      <h2 class="mb-3 text-center" style="color: #3c3c3d;">Manage Members </h2>
        <table class="table text-center table-hover t-member border table-bordered">
          <thead class="theadmember">
            <tr>

              <th scope="col">Full Name</th>
              <th scope="col">Email</th>
              <th scope="col">Gender</th>
              <th scope="col">Registered Date</th>
              <th scope="col">Birthday</th>
              <th scope="col">Control</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php 
             foreach($rows as $row){?>
          
            <tr>
              <td><?php echo $row['UserName'] ?></td>
              <td><?php echo $row['Email'] ?></td>
              <td><?php echo $row['gender'] ?></td>
              <td><?php echo $row['Date'] ?></td>
              <td><?php echo $row['Birthday'] ?></td>
              <td>
                <a href='members.php?do=Edit&userid=<?php echo $row['UserID']?>' class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit</a>
                <a  href='members.php?do=Delete&userid=<?php echo $row['UserID']?>' class="btn btn-danger confirm btn-sm"><i class="fa fa-close"></i>Delete</a>
                <?php 
                if($row['RegStatus'] == 0){?>
              
                <a href='members.php?do=Activate&userid=<?php echo $row['UserID']?>' class="btn btn-info btn-sm activate "><i class="fa fa-check"></i>Activate</a>
               <?php } ?>
              </td>
            </tr>
            <?php 
             }?>
          </tbody>
        </table>
        <a href="members.php?do=Add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add New Member</a>


      </div>
    </div>
  <?php

  } elseif ($do == 'Add') { ?>
    <div class="father-section">
      <div>
        <div class="container">
          <h2 class="edit-title text-center mb-4">Add New Member </h2>
          <form action="?do=Insert" class="" method="POST" enctype="multipart/form-data">
            <div class="row form-group edit-contant">
              <label for="" class="col-sm-2 contol-label">User Name :</label>
              <div class="col-sm-10 edit-input">
                <input type="text" name="username" class="form-control formcontrol" autocomplete="off" placeholder="Enter your Name" >
              </div>
            </div>
            <div class="row form-group edit-contant">
              <label for="" class="col-sm-2 contol-label">Email :</label>
              <div class="col-sm-10 edit-input">
                <input type="email" name="email" class="form-control formcontrol" placeholder="Enter your Email" >
              </div>
            </div>
            <div class="row form-group edit-contant">
              <label for="" class="col-sm-2 contol-label">Password :</label>
              <div class="col-sm-10 edit-input">
                <input type="password" name="password" class="password form-control formcontrol" placeholder="Enter your Password" autocomplete="newpassword" >
                 <i class="show-pass fa fa-eye "></i>
              </div>
            </div>
            <div class="row form-group edit-contant">
              <label for="" class="col-sm-2 contol-label">User image :</label>
              <div class="col-sm-10 edit-input">
                <input type="file" name="avatar" class="form-control formcontrol" placeholder="Enter your image" >
                
              </div>
            </div>
            <div class="row form-group edit-contant">
              <label for="" class="col-sm-2 contol-label">Birthday :</label>
              <div class="col-sm-10 edit-input">
                <input type="date" name="birth" class="form-control formcontrol" placeholder="Enter your Birthday">
              </div>
            </div>
           
            <div class="row form-group edit-contant">
            <label for="" class="col-sm-2 contol-label">Role Type :</label>
            <div class="col-sm-10 edit-input">
            <select class=" form-control formcontrol" name="role">
              <option hidden class="formcontrol"> Role Type</option>
              <?php 
                $stmt = $con->prepare("SELECT * FROM roles");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    $count = $stmt->rowCount();


                    if($count == 0){
                        echo "Error:No exams founded";
                    }
                    else{
                      foreach ($rows as $row) {
                            echo "<option value=".$row['RoleID'].">".$row['RoleName']."</option>";
                        }
                    }
              ?>
            </select>
            </div>
            </div>
            <div class="row form-group edit-contant">
              <label for="" class="col-sm-2 contol-label">Gender :</label>
              <div class="col-sm-10 radio-input">
                <input type="radio" name="gender" value="Male"> <span>Male</span>
                <span class="ml-3"></span>
                <input type="radio" name="gender" value="Female"> <span>Female</span>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 ">
                <input type="submit" value="Add new Member" class="btn btn-primary btn-save">
              </div>

            </div>

          </form>


        </div>
      </div>
    </div>
  <?php


  } elseif ($do == 'Insert') { 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ?>

    <div class="father-section">

      <div class="container">
        <h2 class="edit-title text-center mb-4">Insert Member </h2>
<?php
            
      $avatarName=$_FILES['avatar']['name'];
      $avatarSize=$_FILES['avatar']['size'];
      $avatarTmp=$_FILES['avatar']['tmp_name'];
      $avatarType=$_FILES['avatar']['type'];

      //list of allowed file typed to upload
      $avatarAllowedExtension = array("jpeg","jpg","png","gif");

      //get avatar extention
      $avatarExtension = strtolower(end(explode('.',$avatarName)));



          //Get variables from the form

          $user = $_POST['username'];
          $pass = $_POST['password'];
          $email = $_POST['email'];
          $birth = $_POST['birth'];
          $gender = $_POST['gender'];
          $role =$_POST['role'];

          $hashpass = sha1($_POST['password']);

          //validate the form

          $formerrors = array();

          if (strlen($user) < 4) {
            $formerrors[] = "user name cant be less than<strong> 4 characters</strong>";
          }
          if (strlen($user) > 20) {
            $formerrors[] = 'user name cant be more than<strong> 20 characters</strong>';
          }
          if (empty($user)) {
            $formerrors[] = 'user name cant be empty';
          }
          if (empty($pass)) {
            $formerrors[] = 'password name cant be empty';
          }
          
          if (empty($email)) {
            $formerrors[] = 'email cant be empty';
          }
          if(!empty($avatarName) && ! in_array($avatarExtension,$avatarAllowedExtension)){
            $formerrors[] = 'this extention is not <strong>allowed</strong>';
           }
          
           if($avatarSize > 4194304){
            $formerrors[] = 'image can not be largest than <strong>4MB</strong>';
           }
          foreach ($formerrors as $error) {
            echo "<div class='alert alert-danger'>" . $error . "</div>";
          }


          //check if theres no error proced the update operation 
          if (empty($formerrors)) {

            $avatar =rand(0,1000000)."_".$avatarName;
            move_uploaded_file($avatarTmp,"uploads\avatars\\" . $avatar);

            $check = checkItem('UserName','users',$user);
            if ($check == 1) {

              $themsg = "<div class='alert alert-danger'>sorry this user is exist</div>";
              redirectHome($themsg ,'back');

           } else {
              //insert user information in database

              $stmt = $con->prepare("INSERT INTO users(UserName , Password ,gender,Email ,Birthday ,RegStatus,Date,avatar ,RoleID) VALUES(:user , :pass,:gender,:mail,:birth,1,now(),:avatar,:roleid)");
              $stmt->execute(array(
                'user' => $user,
                'pass' => $hashpass,
                'mail' => $email,
                'birth' => $birth,
                'gender' => $gender,
                'avatar' => $avatar,
                'roleid' => $role
              ));
              //print seccess massage ;

              $themsg = "<div class='alert alert-success'> " . $stmt->rowCount() . " Record inserted</div>";
              redirectHome($themsg ,'back');
           }
          }
          ?>
           </div>
    </div>
          <?php
        } 
        
        else {

          echo "<div class='container'>";
          $themsg = "<div class='alert alert-danger'>sorry you cant browser this page directly</div>";
          redirectHome($themsg,'back',3);
          echo "</div>";
        }


        ?>

    <?php
  } elseif ($do == 'Edit') {

    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
    $stmt = $con->prepare("SELECT * FROM users where UserID = ? limit 1");
    $stmt->execute(array($userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if ($count > 0) {

    ?>
      <div class="father-section">
        <div>
          <div class="container">
            <h2 class="edit-title text-center mb-4">Edit Member </h2>
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
              <!-- <div class="row form-group edit-contant">
              <label for="" class="col-sm-2 contol-label">Gender :</label>
              <div class="col-sm-10 radio-input">
                <input type="radio" name="gender" value="Male"> <span>Male</span>
                <span class="ml-3"></span>
                <input type="radio" name="gender" value="Female"> <span>Female</span>
              </div>
            </div> -->
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

            if ($count == 1) {
              echo '<div class="alert alert-danger">sorry this user is exist</div>';
              //redirectHome($themsg,'back');
            } else {

              //Update the database with this Info
              $stmt = $con->prepare("UPDATE users set UserName = ?, Email = ?, Birthday = ? , Password =? where UserID = ?");
              $stmt->execute(array($user, $email, $birth, $pass, $id));


              $themsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' Record Updated</div>';
              redirectHome($themsg,'back');
            }
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

  } elseif ($do == 'Delete') {?>

<div class="father-section">
          <div class="container">
            <h2 class="edit-title text-center mb-4">Delete Member </h2>
<?php
     // chek if get request userid is numeric & get the integer value of it
     $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ?  intval($_GET['userid']) : 0;

     // select all data depend on this ID
      $stmt = $con ->prepare("SELECT * FROM users where UserID = ? limit 1");
      
       //Execute Query
       $stmt->execute(array($userid));

       //the row count
       $count = $stmt->rowCount();

       //if theres such id show the form
       if($count > 0 ){
    
          $stmt = $con->prepare('DELETE FROM users WHERE UserID = :zuser');
          $stmt->bindParam("zuser",$userid);
          $stmt->execute();
          
          $themsg ="<div class='alert alert-success'> ". $stmt->rowCount() . ' Record Deleted</div>';
          redirectHome($themsg,'back');

       }else{
          $themsg ='<div class="alert alert-danger">this id is not Exist</div>';
          redirectHome($themsg);
       }
       ?>
       </div>
       </div>
<?php
  } elseif ($do == 'Activate') {?>

    <div class="father-section">
              <div class="container">
                <h2 class="edit-title text-center mb-4">Activate Member </h2>
    <?php
  
     // chek if get request userid is numeric & get the integer value of it
     $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ?  intval($_GET['userid']) : 0;

     // select all data depend on this ID
      // $stmt = $con ->prepare("SELECT * FROM users where UserID = ? limit 1");
      $check = checkItem('userid','users',$userid);
       //Execute Query
      // $stmt->execute(array($userid));

       //the row count
       //$count = $stmt->rowCount();

       //if theres such id show the form
       if($check > 0 ){
    
          $stmt = $con->prepare('UPDATE users set RegStatus = 1 where UserID = ?');
         
          $stmt->execute(array($userid));
          
          $themsg ="<div class='alert alert-success'> ". $stmt->rowCount() . ' Record Activated</div>';
          redirectHome($themsg,'back');

       }else{
          $themsg ='<div class="alert alert-danger">this id is not Exist</div>';
          redirectHome($themsg);
       }
       ?>
       </div>
       </div>
<?php
  }

  include $tpl . 'footer.php';
} else {

  header('Location: index.php');
  exit();
}

ob_end_flush();

?>