<?php
error_reporting(false);
ob_start();
session_start();

$pageTitle='Comments';
if(isset($_SESSION['Username'])){

    include 'init.php';

    $do = isset($_GET['do'])? $_GET['do'] : 'Manage';

    if($do=='Manage'){
  
        // select all except admin 
        $stmt=$con->prepare("SELECT comments.*,product.Name as Item_Name ,users.UserName as Member  FROM comments
         INNER JOIN product ON product.Item_ID = comments.item_id
         INNER JOIN users ON users.UserID = comments.user_id
         order by c_id DESC
        ");
        $stmt->execute();

        //assaign to varible
        $rows = $stmt->fetchAll();
        if(!empty($rows)){
    ?>
        <div class="table-member">
          <div class="t-content">
          <h2 class="mb-3 text-center" style="color: #3c3c3d;">Manage Comments </h2>
            <table class="table text-center table-hover t-member border table-bordered">
              <thead class="theadmember">
              <tr>
                    <th>ID</th>
                    <th>Comment</td>
                    <th>Product Name</th>
                    <th>User Name</th>
                    <th>Added Date</th>
                    <th>Control</th>
                </tr>
              </thead>
              <tbody id="myTable">
                <?php 
                foreach($rows as $row){?>
                  <tr>
                    <td><?php echo $row['c_id'];?></td>
                    <td><?php echo $row['comment'];?></td>
                    <td><?php echo $row['Item_Name'];?></td>
                    <td><?php echo $row['Member'];?></td>
                    <td><?php echo $row['comment_date'];?></td>
                    <td>
                        <a href="comments.php?do=Edit&comid=<?php echo $row['c_id']?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit</a>
                        <a href="comments.php?do=Delete&comid=<?php echo $row['c_id']?>" class="btn btn-danger btn-sm confirm"><i class="fa fa-close"></i>Delete</a>
                        <?php
                      if($row['status'] == 0){?>
                     <a href="comments.php?do=Approve&comid=<?php echo $row['c_id']?>" class="btn btn-info btn-sm Activate "><i class="fa fa-check"></i>Approve</a>

                      <?php }
                        ?>
                    </td>
                </tr>                 
                 <?php
                      
                } 
                ?> 
              </tbody>
            </table>    
          </div>
        </div>
      <?php
    }
    // else{
    //     echo '<div class="container">';
    //     echo '<div class="nice-massage alert alert-danger ">There is No comments To show</div>';

    //     echo '</div>';
    // }

    }elseif($do=='Edit'){

    // chek if get request comid is numeric & get the integer value of it
    $comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ?  intval($_GET['comid']) : 0;

    // select all data depend on this ID
      $stmt = $con ->prepare("SELECT * FROM comments where c_id = ? ");
      //Execute Query
      $stmt->execute(array($comid));
      //Fetch the data
      $row = $stmt->fetch();
      //the row count
      $count = $stmt->rowCount();
      //if theres such id show the form
      if($stmt->rowCount()> 0 ){
    
    ?>
      <div class="father-section">
          <div class="container">
            <h2 class="edit-title text-center mb-4">Edit Comment </h2>
            <form action="?do=Update" class="" method="POST">
              <input type="hidden" name="comid" value="<?php echo $comid; ?>">
              <div class="row form-group edit-contant">
                <label for="" class="col-sm-2 contol-label">Comment :</label>
                <div class="col-sm-7 edit-input">
                <textarea class="form-control" name="comment" rows="7" ><?php echo $row['comment'] ?></textarea>
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
    <?php
    } else {
      echo "<div class='container'>";
      $themsg = '<div class="alert alert-danger">theres no such ID</div>';
      redirectHome($themsg);
      echo "</div>";
    }


    }elseif($do=='Update'){?>
        <div class="father-section">
          <div class="container">
            <h2 class="edit-title text-center mb-4">Update Comment </h2>
    
    <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Get variables from the form
            $comid=$_POST['comid'];
            $comment=$_POST['comment'];
          
    
         
            //Update the database with this Info
            $stmt=$con->prepare("UPDATE comments set comment = ? where c_id = ?");
            $stmt->execute(array($comment,$comid));
            //print seccess massage ;
    
           $themsg = "<div class='alert alert-success'> ". $stmt->rowCount() . ' Record Updated</div>';
            redirectHome($themsg,'back');
    
           }else{
             $errormsg = "<div class='alert alert-danger'>sorry you cant browser this page directly</div>";
             redirectHome($errormsg);
               //echo "sorry you cant browser this page directly";
           }

      ?>
          </div>
       </div>
<?php

    }elseif($do=='Delete'){?>
    
    <div class="father-section">
        <div class="container">
          <h2 class="edit-title text-center mb-4">Delete Comment </h2>
 <?php
 // chek if get request comid is numeric & get the integer value of it
 $comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ?  intval($_GET['comid']) : 0;

 // select all data depend on this ID
  $check = checkItem('c_id','comments',$comid);
  
   //if theres such id show the form
   if($check > 0 ){

      $stmt = $con->prepare('DELETE FROM comments WHERE c_id = :zid');
      $stmt->bindParam("zid",$comid);
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
    }elseif($do=='Approve'){?>

    <div class="father-section">
              <div class="container">
                <h2 class="edit-title text-center mb-4">Approve Comment </h2>
    <?php

            $comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ?  intval($_GET['comid']) : 0;

            // select all data depend on this ID

            $check = checkItem('c_id','comments',$comid);

            //if theres such id show the form
            if($check > 0 ){

                $stmt = $con->prepare('UPDATE comments set status = 1 where c_id = ?');
                
                $stmt->execute(array($comid));
                
                $themsg ="<div class='alert alert-success'> ". $stmt->rowCount() . ' Comment Approved</div>';
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

}else{

  header('Location:index.php');
  exit();

}

ob_end_flush();

?>







